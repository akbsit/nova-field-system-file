<?php namespace Falbar\NovaFieldSystemFile\Field;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Field;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

use Falbar\SystemFile\Models\SystemFile;
use Exception;

abstract class Media extends Field
{
    public $component = 'nova-field-system-file';

    public $textAlign = 'center';

    protected string $sOriginFileName = '';
    protected string $sFileName = '';
    protected string $sDir = SystemFile::DIR_DEFAULT;
    protected bool $bIsPartition = false;

    protected array $arDefaultRuleList = [];
    private array $arRuleList = [];

    public function toDir(string $sDir): self
    {
        $this->sDir = $sDir;

        return $this;
    }

    public function enablePartition(): self
    {
        $this->bIsPartition = true;

        return $this;
    }

    public function setOriginFileName(string $sOriginFileName): self
    {
        $this->sOriginFileName = $sOriginFileName;

        return $this;
    }

    public function setFileName(string $sFileName): self
    {
        $this->sFileName = $sFileName;

        return $this;
    }

    public function self(): self
    {
        $this->withMeta(['self' => true]);

        return $this;
    }

    public function rules($rules): self
    {
        $this->arRuleList = ($rules instanceof Rule || is_string($rules)) ? func_get_args() : $rules;

        if ($this->isValidateRequired()) {
            $this->required();
        }

        return $this;
    }

    /* @inheritDoc */
    public function resolve($oModel, $sAttribute = null)
    {
        if (empty($oModel)) {
            return;
        }

        /* @var SystemFile $oFile */
        if (!$oModel instanceof SystemFile) {
            $sCollection = $sAttribute ?? $this->attribute;
            if (empty($sCollection)) {
                return;
            }

            $oFile = $oModel->getMediaFirst($sCollection);
        } else {
            $oFile = $oModel->exists ? $oModel : null;
        }

        if (empty($oFile)) {
            return;
        }

        $this->value = [
            'file'      => null,
            'file_url'  => $oFile->getUrl(),
            'file_name' => $oFile->file_name,
        ];
    }

    /* @inheritDoc */
    protected function fillAttributeFromRequest(NovaRequest $oRequest, $sRequestCollection, $oModel, $sCollection)
    {
        $this->validate($oRequest, $sRequestCollection, $oModel);

        return function () use ($oRequest, $sRequestCollection, $oModel) {
            $this->handleMedia($oRequest, $sRequestCollection, $oModel);
        };
    }

    /**
     * @param NovaRequest  $oRequest
     * @param string       $sRequestCollection
     * @param object|Model $oModel
     *
     * @throws ValidationException
     */
    private function validate($oRequest, $sRequestCollection, $oModel): void
    {
        /* @var UploadedFile|string $oFile */
        $oFile = Arr::get($oRequest, '__file__.' . $sRequestCollection);
        if (is_null($oFile) && !$this->isValidateRequired()) {
            return;
        }

        if ($oFile === 'null' && !$this->isValidateRequired()) {
            return;
        }

        if (is_null($oFile) &&
            $this->isValidateRequired() &&
            !empty($oModel) &&
            $oModel->mediaExists($sRequestCollection)) {
            return;
        }

        $arRuleList = array_merge($this->arRuleList, $this->arDefaultRuleList);
        $arRuleList = array_unique($arRuleList);

        Validator::make([$sRequestCollection => $oFile], [$sRequestCollection => $arRuleList])
            ->validate();
    }

    /**
     * @param NovaRequest  $oRequest
     * @param string       $sRequestCollection
     * @param object|Model $oModel
     */
    private function handleMedia(NovaRequest $oRequest, $sRequestCollection, $oModel): void
    {
        /* @var UploadedFile|string $oFile */
        $oFile = Arr::get($oRequest, '__file__.' . $sRequestCollection);
        if (empty($oFile) || empty($oModel)) {
            return;
        }

        switch ($oFile) {
            case $oFile instanceof UploadedFile:
                $oMedia = $oModel->addMedia($oFile)->single()->toCollection($sRequestCollection);
                if ($this->bIsPartition) {
                    $oMedia->enablePartition();
                }

                if ($this->sFileName) {
                    $oMedia->setFileName($this->sFileName);
                }

                if ($this->sOriginFileName) {
                    $oMedia->setOriginFileName($this->sOriginFileName);
                }

                if ($this->sDir) {
                    $oMedia->toDir($this->sDir);
                }

                $oMedia->put();
                break;
            case 'null':
                $oModel->getMedia($sRequestCollection)
                    ->each(function ($oFileItem) {
                        try {
                            /* @var SystemFile $oFileItem */
                            $oFileItem->delete();
                        } catch (Exception $oException) {
                            return true;
                        }
                    });
                break;
        }
    }

    private function isValidateRequired(): bool
    {
        return in_array('required', $this->arRuleList);
    }
}
