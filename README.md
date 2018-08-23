# Instagram

![instagram](https://cloud.githubusercontent.com/assets/499192/11020990/f0f31dea-8632-11e5-95b1-77e72c7ba271.png)

> An easy-to-use and simple [Instagram](https://www.instagram.com/) package.

```php
use Vinkla\Instagram\Instagram;

// Create a new instagram instance.
$instagram = new Instagram('your-access-token');

// Fetch recent user media items.
$instagram->media();

// Fetch user information.
$instagram->self();
```

[![Build Status](https://badgen.net/travis/vinkla/instagram/master)](https://travis-ci.org/vinkla/instagram)
[![Coverage Status](https://badgen.net/codecov/c/github/vinkla/instagram)](https://codecov.io/github/vinkla/instagram)
[![Total Downloads](https://badgen.net/packagist/dt/vinkla/instagram)](https://packagist.org/packages/vinkla/instagram)
[![Latest Version](https://badgen.net/github/release/vinkla/instagram)](https://github.com/vinkla/instagram/releases)
[![License](https://badgen.net/packagist/license/vinkla/instagram)](https://packagist.org/packages/vinkla/instagram)

## Installation

Instagram is decoupled from any library sending HTTP requests (like Guzzle), instead it uses an abstraction called [HTTPlug](http://httplug.io) which provides the http layer used to send requests to exchange rate services. This gives you the flexibility to choose what HTTP client and PSR-7 implementation you want to use.

Read more about the benefits of this and about what different HTTP clients you may use in the [HTTPlug documentation](http://docs.php-http.org/en/latest/httplug/users.html). Below is an example using [Guzzle 6](http://docs.guzzlephp.org/en/latest/index.html):

```bash
composer require vinkla/instagram php-http/message php-http/guzzle6-adapter
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

To fetch the user's recent media items you may use the `media()` method.

```php
$instagram->media();
```

To fetch the user information data you may use the `self()` method.

```php
$instagram->self();
```

> **Note:** You can only fetch a user's recent media from the given access token.

## Rate Limiting

The Instagram allows you to call their API 200 times per hour. Try to cache the responses in your application.

> _The Instagram API uses the same rate limiting as the Graph API (200 calls per user per hour) with one exception: the /media/comments edge limits writes to 60 writes per user per hour. Please refer to the Graph API's rate limiting documentation for more information_ - [Facebook](https://developers.facebook.com/docs/instagram-api/overview/#rate-limiting)

## License

[MIT](LICENSE) © [Vincent Klaiber](https://vinkla.com)
