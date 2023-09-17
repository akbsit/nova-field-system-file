# nova-field-system-file, [Packagist](https://packagist.org/packages/akbsit/nova-field-system-file), [Nova packages](https://novapackages.com/packages/akbsit/nova-field-system-file)

## Install

To install package, you need run command:

```bash
composer require akbsit/nova-field-system-file
```

Next install migrations:

```bash
php artisan migrate
```

## Подключение

Package based on [akbsit/laravel-system-file](https://github.com/akbsit/laravel-system-file) in repository which describes the connection to the model.

## Examples

Second parameter is responsible for the collection to which the saved images or files will belong.

1. Upload image:

```php
public function fields(HttpRequest $oHttpRequest)
{
    return [
        Image::make(__('Image'), 'image'),
    ];
}
```

2. Upload file:

```php
public function fields(HttpRequest $oHttpRequest)
{
    return [
        File::make(__('File'), 'file'),
    ];
}
```

3. Fields support validation via the method `rules`:

```php
public function fields(HttpRequest $oHttpRequest)
{
    return [
        Image::make(__('Image'), 'image')
            ->rules('required', 'max:1000'),
        File::make(__('File'), 'file')
            ->rules('required', 'max:5000'),
    ];
}
```

## Methods and properties

* `enablePartition()` - enable folder generation (example: `73c/d53/dce`);
* `setOriginFileName(string $sOriginFileName)` - set origin file name;
* `setFileName(string $sFileName)` - set file name;
* `toDir(string $sDir)` - set storage folder (by default `default`);
* `self()` - specified if the model `SystemFile` (by default `false`).
