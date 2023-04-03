<?php namespace Falbar\NovaFieldSystemFile\Field;

class File extends Media
{
    public $meta = ['type' => 'file'];

    protected array $arDefaultRuleList = [];
}
