Yii 2 Timezone
==============
Timezone component for Yii 2

[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-timezone/v/stable)](https://packagist.org/packages/yii2mod/yii2-timezone) [![Total Downloads](https://poser.pugx.org/yii2mod/yii2-timezone/downloads)](https://packagist.org/packages/yii2mod/yii2-timezone) [![License](https://poser.pugx.org/yii2mod/yii2-timezone/license)](https://packagist.org/packages/yii2mod/yii2-timezone)

Installation   
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/yii2-timezone "*"
```

or add

```json
"yii2mod/yii2-timezone": "*"
```

to the require section of your composer.json.

Usage
------------
> Currently firefox and edge browsers are not supported.

Once the extension is installed, simply add component to your main config file:

```php
    'bootstrap' => [
        'timezone'
    ]
    .....
    'components' => [
        'timezone' => [
            'class' => 'yii2mod\timezone\Timezone',
            'actionRoute' => '/site/timezone' //optional param - full path to page must be specified
        ],
    ]

```

Then add new action to any controller (SiteController by default)

```php
public function actions()
    {
        return [
            'timezone' => [
                'class' => 'yii2mod\timezone\TimezoneAction',
            ],
        ];
    }

```
After configuration you can use ``` Yii::$app->timezone->name``` to get current user's timezone.
