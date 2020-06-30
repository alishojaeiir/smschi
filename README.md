[![](smschi.png?raw=true)](smschi.png?raw=true)

# Laravel Sending SMS

[![Latest Stable Version](https://poser.pugx.org/alishojaeiir/smschi/v)](//packagist.org/packages/alishojaeiir/smschi)
[![Total Downloads](https://poser.pugx.org/alishojaeiir/smschi/downloads)](//packagist.org/packages/alishojaeiir/smschi) 
[![Latest Unstable Version](https://poser.pugx.org/alishojaeiir/smschi/v/unstable)](//packagist.org/packages/alishojaeiir/smschi) 
[![License](https://poser.pugx.org/alishojaeiir/smschi/license)](//packagist.org/packages/alishojaeiir/smschi)
[![StyleCI](https://github.styleci.io/repos/274625616/shield?branch=master)](https://github.styleci.io/repos/274625616)
[![Code Quality Score](https://www.code-inspector.com/project/10280/score/svg)](https://frontend.code-inspector.com/public/project/10280/smschi/dashboard)

This is a Laravel Package for Sending sms. This package supports `Laravel 5.8+`.

> This packages works with multiple drivers, and you can create custom drivers if you can't find them in the [current drivers list](https://github.com/alishojaeiir/smschi#list-of-available-drivers) (below list).

# List of contents

* [Laravel Sending SMS](https://github.com/alishojaeiir/smschi#laravel-sending-sms)
* [List of contents](https://github.com/alishojaeiir/smschi#list-of-contents)
* [List of available drivers](https://github.com/alishojaeiir/smschi#list-of-available-drivers)
  * [Install](https://github.com/alishojaeiir/smschi#install)
  * [Configure](https://github.com/alishojaeiir/smschi#configure)
  * [Security](https://github.com/alishojaeiir/smschi#security)
  * [Credits](https://github.com/alishojaeiir/smschi#credits)
  * [License](https://github.com/alishojaeiir/smschi#license)

# List of available drivers

* [parsasms](http://parsasms.com/)


## Install

Via Composer

```shell
$ composer require alishojaeiir/smschi
```

## Configure

If you are using `Laravel 5.5` or higher then you don't need to add the provider and alias. (Skip to b)

a. In your `config/app.php` file add these two lines.

```php
// In your providers array.
'providers' => [
...
/*
 * Package Service Providers...
 */
 
Alishojaeiir\Smschi\SmschiServiceProvider::class,
/*
 * Application Service Providers...
 */
...
],

// In your aliases array.
'aliases' => [
...
'smschi' => Alishojaeiir\Smschi\SmschiFacade::class,
],
```

b. then run `php artisan vendor:publish` to publish `config/smschi.php` file in your config directory.

In the config file you can set the `default driver` to use for all sending. But you can also change the driver at runtime.

Choose what provider you would like to use in your application. Then make that as default driver so that you don't have to specify that everywhere. But, you can also use multiple providers in a project.

```php
// Eg. if you want to use parsasms.
'default' => 'parsasms',
```

Then fill the credentials for that gateway in the drivers array.

```php
'drivers' => [
        'parsasms' => [
            'apiUrl' => "http://api.smsapp.ir/v2/sms/",
            'apiKey' => "api_key",
            'sender' => "sender number",
        ],
...
]
```

## How to use

In your code, use it like the below:

```php
\smschi::prepare($receiver, $message)->send();

```

## Security

If you discover any security related issues, please email [alishojaei34@gmail.com](mailto:alishojaei34@gmail.com) instead of using the issue tracker.

## Credits

* [Ali Shojaei](https://github.com/alishojaeiir)
* [All Contributors](https://github.com/alishojaeiir/smschi/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/shetabit/payment/blob/master/LICENSE.md) for more information.
