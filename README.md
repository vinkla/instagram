Laravel Instagram
=================
![image](https://raw.githubusercontent.com/vinkla/vinkla.github.io/master/images/laravel-instagram.png)

Laravel [Instagram](http://instagram.com/developer) is an [Instagram](http://instagram.com/developer) bridge for Laravel. [Instagram](http://instagram.com/developer) API package is made by [Christian Metz](https://github.com/cosenary/Instagram-PHP-API). The Laravel wrapper package is created and maintained by [Vincent Klaiber](https://github.com/vinkla).

```php
// Fetching data.
$instagram->getUserFeed(30);

// Get popular media.
$instagram->getPopularMedia();

// Want to use the facade?
Instagram::searchMedia(48.1454418, 11.5686003);
```

[![Build Status](https://img.shields.io/travis/vinkla/instagram/master.svg?style=flat)](https://travis-ci.org/vinkla/instagram)
[![StyleCI](https://styleci.io/repos/15844313/shield?style=flat)](https://styleci.io/repos/15844313)
[![Latest Version](https://img.shields.io/github/release/vinkla/instagram.svg?style=flat)](https://github.com/vinkla/instagram/releases)
[![License](https://img.shields.io/packagist/l/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/instagram
```

Add the service provider to ```config/app.php``` in the `providers` array.

```php
'Vinkla\Instagram\InstagramServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in ```config/app.php``` to your aliases array.

```php
'Instagram' => 'Vinkla\Instagram\Facades\Instagram'
```

#### Looking for a Laravel 4 compatible version?

Please use [1.0 branch](https://github.com/vinkla/instagram/tree/1.0) instead. Installable by requiring:

```bash
composer require vinkla/instagram:~1.0
```

## Configuration

Laravel Instagram requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/instagram.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Instagram Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### InstagramManager

This is the class of most interest. It is bound to the ioc container as `instagram` and can be accessed using the `Facades\Instagram` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `MetzWeb\Instagram\Instagram`.

#### Facades\Instagram

This facade will dynamically pass static method calls to the `instagram` object in the ioc container which by default is the `InstagramManager` class.

#### InstagramServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Vinkla\Instagram\Facades\Instagram;

// Get code parameter.
$code = Request::get('code');

// Request the access token.
$data = Instagram::getOAuthToken($code);

// Set the access token with $data object.
Instagram::setAccessToken($data);

// We're done here - how easy was that, it just works!
Instagram::getUserLikes();
// This example is simple, and there are far more methods available.
```

The Instagram manager will behave like it is a `MetzWeb\Instagram\Instagram`. If you want to call specific connections, you can do that with the connection method:

```php
use Vinkla\Instagram\Facades\Instagram;

// Writing this…
Instagram::connection('main')->getUserLikes();

// …is identical to writing this
Instagram::getUserLikes();

// and is also identical to writing this.
Instagram::connection()->getUserLikes();

// This is because the main connection is configured to be the default.
Instagram::getDefaultConnection(); // This will return main.

// We can change the default connection.
Instagram::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Vinkla\Instagram\InstagramManager;

class Foo
{
	protected $instagram;

	public function __construct(InstagramManager $instagram)
	{
		$this->instagram = $instagram;
	}

	public function bar()
	{
		$this->instagram->getPopularMedia();
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Christian Metz's](https://github.com/cosenary) [Instagram API package](https://github.com/cosenary/Instagram-PHP-API).

## License

Laravel Instagram is licensed under [The MIT License (MIT)](LICENSE).
