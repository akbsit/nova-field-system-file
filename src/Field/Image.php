<?php namespace Akbsit\NovaFieldSystemFile\Field;

final class Image extends Media
{
    public $meta = [
        'type' => 'image',
        'self' => false,
    ];

    protected array $arDefaultRuleList = ['image'];
}
