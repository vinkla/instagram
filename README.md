# Instagram

![instagram](https://cloud.githubusercontent.com/assets/499192/11020990/f0f31dea-8632-11e5-95b1-77e72c7ba271.png)

> An easy-to-use and simple [Instagram](https://www.instagram.com/) package.

```php
use Vinkla\Instagram\Instagram;

// Create a new instagram instance.
$instagram = new Instagram('jerryseinfeld');

// Fetch the media feed.
$instagram->get();
```

[![Build Status](https://img.shields.io/travis/vinkla/instagram/master.svg?style=flat)](https://travis-ci.org/vinkla/instagram)
[![StyleCI](https://styleci.io/repos/27216826/shield?style=flat)](https://styleci.io/repos/27216826)
[![Coverage Status](https://img.shields.io/codecov/c/github/vinkla/instagram.svg?style=flat)](https://codecov.io/github/vinkla/instagram)
[![Latest Version](https://img.shields.io/github/release/vinkla/instagram.svg?style=flat)](https://github.com/vinkla/instagram/releases)
[![License](https://img.shields.io/packagist/l/vinkla/instagram.svg?style=flat)](https://packagist.org/packages/vinkla/instagram)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/instagram
```

## Usage

First you need to create a new `Vinkla\Instagram\Instagram` instance.

```php
use Vinkla\Instagram\Instagram;

$instagram = new Instagram('jerryseinfeld');
```

Then to fetch the data you can use the `get()` method.

```php
$instagram->get();
```

## License

[MIT](LICENSE) © [Vincent Klaiber](https://vinkla.com)
