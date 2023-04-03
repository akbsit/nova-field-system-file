<?php namespace Falbar\NovaFieldSystemFile\Field;

class Image extends Media
{
    public $meta = ['type' => 'image'];

    protected array $arDefaultRuleList = ['image'];
}
