##### [Главная страница](../readme.md)

# Установка и настройка

## Composer

Подключение модуля необходимо проводить находясь в DOCUMENT_ROOT проекта:

```
composer require worksolutions/bitrix-module-bunit
```

Команда перенесет файлы модуля в папку `/bitrix/modules/ws.bunit`
Следующим шагом будет регистрация модуля в ядре Битрикс:

```
composer run-script post-install-cmd -d bitrix/modules/ws.bunit
```

Либо со страницы "Установленные решения", минуя командную строку:
```
/bitrix/admin/partner_modules.php?lang=ru
```

## Marketplace

Модуль доступен, но не опубликован на маркетплейс Битрикса. Маркетплейс используется только как площадка установки и обновления модуля через web интерфе. Основной лощадкой поддержки модуля является [github](https://github.com/worksolutions/bitrix-module-bunit/blob/master/readme.md).

Для установки в адресную строку сайта, после доменного имени, прописать:

```
/bitrix/admin/update_system_partner.php?addmodule=ws.bunit
```

Установка модуля осуществляется без установки параметров.

## Файл настройки

Для начала работы отредактировать файл ```КОРЕНЬ_ПРОЕКТА/bitrix/php_interface/bunit/config.php```.
После установки он выглядит так:
```php
<?php

global $DB;

$charset = defined("BX_UTF") ? "UTF-8" : "cp1251";

$config = \WS\BUnit\Config::getDefaultConfig();

$config->set(
    array(
        'db' => array(
            'original' => array(
                'host' => $DB->DBHost,
                'user' => $DB->DBLogin,
                'password' => $DB->DBPassword,
                'db' => $DB->DBName,
                'charset' => $charset
            ),
            /*
            Use it if you have test clone of real database
            'test' => array(
                'host' => $DB->DBHost,
                'user' => $DB->DBLogin,
                'password' => $DB->DBPassword,
                // write name of test database
                'db' => '',
                'charset' => $charset
            )
             */
        ),
        'folder' => __DIR__."/tests"
    )
);
```

Основная настройка состоит из двух пунктов: ```db```, ```folder```.

1. ```db``` - содержит параметры доступов баз данных, как оригинальной так и тестовой. В случае если описание тестовой базы данных отсутствует, при проходе тестов будет использоваться основная база данных проекта.
2. ```folder``` - указывает на каталог содержащий тестовые классы. По умолчанию определен текущий каталог: ```КОРЕНЬ_ПРОЕКТА/bitrix/php_interface/bunit/```

## Каталог тестовых классов

Каталог тестовых классов может также содержать подкаталоги для удобного группирования тестов. Все файлы тестов должны иметь в названии постфикс ```TestCase```. Например: *CardAddingTestCase.php*. Файлы название которых не удовлетворяет правилу подключения не будут подключены при проходе тестов. Это удобно в тех случаях когда выделяются файлы с какими-то данными которые нужно подключить при тестировании в определенных местах тестов, а не подключать их автоматически при запуске.
