# nova-field-system-file, [Packagist](https://packagist.org/packages/falbar/nova-field-system-file), [Nova packages](https://novapackages.com/packages/falbar/nova-field-system-file)

## Установка

Для установки пакета нужно:

```bash
composer require falbar/nova-field-system-file
```

Далее установить миграции:

```bash
php artisan migrate
```

## Подключение

Пакет написан на основе [falbar/laravel-system-file](https://github.com/falbarRu/laravel-system-file) в репозитории которого описано подключение к модели.

## Примеры использования

Второй параметр отвечает за коллекцию, к которой будут относится сохраненные изображения или файлы.

1. Загрузить изображение:

```php
public function fields(HttpRequest $oHttpRequest)
{
    return [
        Image::make(__('Image'), 'image'),
    ];
}
```

2. Загрузить файл:

```php
public function fields(HttpRequest $oHttpRequest)
{
    return [
        File::make(__('File'), 'file'),
    ];
}
```

3. Поля поддерживают валидацию через метод `rules`:

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

## Список методов и свойств

* `enablePartition()` - включить генерацию папок (пример: `73c/d53/dce`);
* `setOriginFileName(string $sOriginFileName)` - указать имя файла;
* `setFileName(string $sFileName)` - указать название файла;
* `toDir(string $sDir)` - указать папку для хранения (по умолчанию `default`).
