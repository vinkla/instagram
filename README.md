# Instagram

![instagram](https://cloud.githubusercontent.com/assets/499192/11020990/f0f31dea-8632-11e5-95b1-77e72c7ba271.png)

> An easy-to-use and simple [Instagram](https://www.instagram.com/) package.

```php
use Vinkla\Instagram\Instagram;

// Create a new instagram instance.
$instagram = new Instagram('your-access-token');

// Fetch the user's recent media feed.
$instagram->get();

// Get user information
$instagram->me();
```

[![Build Status](https://img.shields.io/travis/vinkla/instagram/master.svg?style=flat)](https://travis-ci.org/vinkla/instagram)
[![StyleCI](https://styleci.io/repos/27216826/shield?style=flat)](https://styleci.io/repos/27216826)
[![Coverage Status](https://img.shields.io/codecov/c/github/vinkla/instagram.svg?style=flat)](https://codecov.io/github/vinkla/instagram)
[![Total Downloads](https://img.shields.io/packagist/dt/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)
[![Latest Version](https://img.shields.io/github/release/vinkla/instagram.svg?style=flat)](https://github.com/vinkla/instagram/releases)
[![License](https://img.shields.io/packagist/l/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)

## Installation

Instagram is decoupled from any library sending HTTP requests (like Guzzle), instead it uses an abstraction called [HTTPlug](http://httplug.io) which provides the http layer used to send requests to exchange rate services. This gives you the flexibility to choose what HTTP client and PSR-7 implementation you want to use.

Read more about the benefits of this and about what different HTTP clients you may use in the [HTTPlug documentation](http://docs.php-http.org/en/latest/httplug/users.html). Below is an example using [Guzzle 6](http://docs.guzzlephp.org/en/latest/index.html):

```bash
$ composer require vinkla/instagram php-http/message php-http/guzzle6-adapter
```

## Usage

First you need to generate an access token using Pixel Union's [access token generator](http://instagram.pixelunion.net) or by creating an [Instagram application](https://www.instagram.com/developer/authentication).

```
5937104658.5688ed0.675p84e21a0341gcb3b44b1a13d9de91
```

Then create a new `Vinkla\Instagram\Instagram` instance with your Instagram access token.

```php
use Vinkla\Instagram\Instagram;

$instagram = new Instagram('5937104658.5688ed0.675p84e21a0341gcb3b44b1a13d9de91');
```

To fetch the user's recent media data you may use the `get()` method.

```php
$instagram->get();
```

To get the user informationfetch data you may use the `me()` method.

```php
$instagram->me();
```

> **Note:** You can only fetch a user's recent media from the given access token.

## License

[MIT](LICENSE) © [Vincent Klaiber](https://vinkla.com)
