Yii2 extension for Sypex Geo API (http://sypexgeo.net)
======================================================

This extension adds support for Sypex Geo to the Yii2 framework

**Note:** This is _not_ the fork of the [JiSoft/yii2-sypexgeo](https://github.com/JiSoft/yii2-sypexgeo)!

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist omnilight/yii2-sypexgeo "*"
```

or add

```json
"omnilight/yii2-sypexgeo": "*"
```

to the `require` section of your composer.json.

What it is all about?
---------------------

Sypex Geo - product for location by IP address. Obtaining the IP address, Sypex Geo outputs information about 
the location of the visitor - country, region, city, geographical coordinates and other in Russian and in English. 
Sypex Geo use local compact binary database file and works very quickly. 
For more information visit: http://sypexgeo.net/

This is extension for Yii2 framework that makes it easy to deal with Sypex Geo.


Usage
-----

Unfortunately original version of Sypex Geo does not support Composer installation, so we have to include it into
this extension.

First of all, you have to download desired database from the http://sypexgeo.net/ website and place it somewhere
on your server.

There are two classes in this extension.

**Sypexgeo** - this is the component that can be used to retrive Geo information based on IP address. This component
incapsulates calls to the SxGeo methods.

You can use it as an application component:

```php
// config.php
[
    'components' => [
        'sypexGeo' => [
            'class' => 'omnilight\sypexgeo\Sypexgeo',
            'database' => '@app/data/SxGeoCity.dat',
        ]
    ]
]

// somewhere in your code
$city = Yii::$app->sypexGeo->getCity($ip);
```

Also you can create instance by yourself:

```php

$sypexGeo = new omnilight\sypexgeo\Sypexgeo([
    'database' => '@app/data/SxGeoCity.dat',
]);
$city = $sypexGeo->getCity($ip);
``

**GeoBehavior** - behavior that can be attached to the `yii\web\Request` or it's children and this class adds methods
to simplify getting Geo information for current request.
 
Example:

```php
// config.php
[
    'components' => [
        'request' => [
            'as sypexGeo' => [
                'class' => 'omnilight\sypexgeo\GeoBehavior',
                // It is not required to define property sypexGeo if you have sypexGeo component defined
                // in your application
                'sypexGeo' => [
                    'database' => '@app/data/SxGeoCity.dat',
                ]
            ]
        ]
    ],
]

```
