Laravel Instagram
=================
![image](https://raw.githubusercontent.com/vinkla/vinkla.github.io/master/images/laravel-instagram.png)

Laravel wrapper for the Instagram API made by [@cosenary](https://github.com/cosenary/Instagram-PHP-API). Read more about the [API in its repository](https://github.com/cosenary/Instagram-PHP-API).

```php
// Fetching data.
$instagram->getUserFeed(30);

// Get popular media.
$instagram->getPopularMedia();

// Wanna use the facade?
Instagram::searchMedia(48.1454418, 11.5686003);
```

[![Build Status](https://img.shields.io/travis/vinkla/instagram/master.svg?style=flat)](https://travis-ci.org/vinkla/instagram)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)
[![License](https://img.shields.io/packagist/l/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)

## Installation
Require this package in your `composer.json` and update composer.

```json
{
	"require": {
		"vinkla/instagram": "~1.0"
	}
}
```

Add the service provider to ```config/app.php``` in the providers array.

```php
'Vinkla\Instagram\InstagramServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/4.2/facades). Add the reference in ```config/app.php``` to your aliases array.
```php
'Instagram' => 'Vinkla\Instagram\Facades\Instagram'
```

To add the configuration file to your `app/config/packages` directory, run the command below.
```bash
php artisan publish:config vinkla/instagram
```

## License

The Laravel Instagram package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
