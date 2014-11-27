Laravel Instagram
=================

Laravel wrapper for the Instagram API. Read more about the [API class repository](https://github.com/cosenary/Instagram-PHP-API).

## Installation
Require this package in your `composer.json` and update composer. 

```json
{
	"require": {
		"vinkla/instagram": "~1.0"
	}
}
```

If using [Laravel](http://laravel.com) (not required), add the service provider to ```config/app.php``` in the providers array.

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
