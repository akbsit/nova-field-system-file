<?php namespace Falbar\NovaFieldSystemFile\Field;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Field;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Media
 * @package Falbar\NovaFieldSystemFile\Field
 */
class Media extends Field
{
    /* @inheritDoc */
    public $component = 'nova-field-system-file';

    protected string $sOriginFileName;
    protected string $sFileName;
    protected string $sDir;
    protected bool $bIsPartition;

    /**
     * @param string $sDir
     *
     * @return $this
     */
    public function toDir(string $sDir): self
    {
        $this->sDir = $sDir;

        return $this;
    }

    /* @return $this */
    public function enablePartition(): self
    {
        $this->bIsPartition = true;

        return $this;
    }

    /**
     * @param string $sOriginFileName
     *
     * @return $this
     */
    public function setOriginFileName(string $sOriginFileName): self
    {
        $this->sOriginFileName = $sOriginFileName;

        return $this;
    }

    /**
     * @param string $sFileName
     *
     * @return $this
     */
    public function setFileName(string $sFileName): self
    {
        $this->sFileName = $sFileName;

        return $this;
    }

    /* @inheritDoc */
    public function resolve($oModel, $sAttribute = null)
    {
    }

    /* @inheritDoc */
    protected function fillAttributeFromRequest(NovaRequest $oRequest, $sRequestCollection, $oModel, $sCollection)
    {
        return function () use ($oRequest, $sRequestCollection, $oModel, $sCollection) {
            $this->handleMedia($oRequest, $sRequestCollection, $oModel, $sCollection);
        };
    }

    /**
     * @param NovaRequest  $oRequest
     * @param string       $sRequestCollection
     * @param object|Model $oModel
     * @param string       $sCollection
     *
     * @return void
     */
    private function handleMedia(NovaRequest $oRequest, $sRequestCollection, $oModel, $sCollection): void
    {
    }
}
