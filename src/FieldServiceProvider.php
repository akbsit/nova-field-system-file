<?php namespace Akbsit\NovaFieldSystemFile;

use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $oEvent) {
            Nova::script('nova-field-system-file', __DIR__ . '/../dist/js/field.js');
            Nova::style('nova-field-system-file', __DIR__ . '/../dist/css/field.css');
        });
    }
}
