<?php namespace Falbar\NovaFieldSystemFile\Field;

/**
 * Class Image
 * @package Falbar\NovaFieldSystemFile\Field
 */
class Image extends Media
{
    /* @inheritDoc */
    public $meta = ['type' => 'image'];

    protected array $arDefaultRuleList = ['image'];
}
