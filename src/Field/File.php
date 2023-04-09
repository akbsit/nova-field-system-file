<?php namespace Falbar\NovaFieldSystemFile\Field;

final class File extends Media
{
    public $meta = [
        'type' => 'file',
        'self' => false,
    ];

    protected array $arDefaultRuleList = [];
}
