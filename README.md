Laravel Instagram
=================

![instagram](https://cloud.githubusercontent.com/assets/499192/11020990/f0f31dea-8632-11e5-95b1-77e72c7ba271.png)

Laravel [Instagram](http://instagram.com/developer) is an [Instagram](http://instagram.com/developer) bridge for Laravel and Lumen.

```php
// Fetch user data.
$instagram->users()->get(30);

// Get liked media.
$instagram->users()->getLikedMedia();

// Want to use the facade?
Instagram::likes()->like(413);
```

[![Build Status](https://img.shields.io/travis/vinkla/laravel-instagram/master.svg?style=flat)](https://travis-ci.org/vinkla/laravel-instagram)
[![StyleCI](https://styleci.io/repos/27216826/shield?style=flat)](https://styleci.io/repos/27216826)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/instagram.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/instagram/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/instagram.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/instagram)
[![Latest Version](https://img.shields.io/github/release/vinkla/instagram.svg?style=flat)](https://github.com/vinkla/instagram/releases)
[![License](https://img.shields.io/packagist/l/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/instagram
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Instagram\InstagramServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Instagram' => Vinkla\Instagram\Facades\Instagram::class
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

This is the class of most interest. It is bound to the ioc container as `instagram` and can be accessed using the `Facades\Instagram` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Larabros\Elogram\Client`.

#### Facades\Instagram

This facade will dynamically pass static method calls to the `instagram` object in the ioc container which by default is the `InstagramManager` class.

#### InstagramServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Vinkla\Instagram\Facades\Instagram;

Instagram::users()->get(30);
// We're done here - how easy was that, it just works!

Instagram::likes()->get(101);
// This example is simple, and there are far more methods available.
```

The Instagram manager will behave like it is a `Larabros\Elogram\Client`. If you want to call specific connections, you can do that with the connection method:

```php
use Vinkla\Instagram\Facades\Instagram;

// Writing this…
Instagram::connection('main')->users()->get(30);

// …is identical to writing this
Instagram::users()->get(30);

// and is also identical to writing this.
Instagram::connection()->users()->get(30);

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
		$this->instagram->users()->get(30);
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Larabros's](https://github.com/larabros) [Elogram package](https://github.com/larabros/elogram).

## License

Laravel Instagram is licensed under [The MIT License (MIT)](LICENSE).
