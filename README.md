# Readable Numbers

[![EgoistDeveloper Readable Numbers](https://preview.dragon-code.pro/EgoistDeveloper/Readable-Numbers.svg?brand=laravel)](https://github.com/laravel-ready/readable-numbers)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

Human readable numbers for Laravel. In some cases, you may need to format numbers in a way that is easier to read. Especially when you are dealing with numbers that are very large, for example we want to show page views and we have `100000000` views. So we can show it in the `100M` format.

## Installation

```bash
composer require laravel-ready/readable-numbers
```

## Thresholds

| Threshold          | Suffix      | Result |
| ------------------ | ----------- | ------ |
| 900                |             | 900    |
| 900.000            | k           | 0.9 K  |
| 900.000.000        | m           | 0.9 M  |
| 900.000.000.000    | b           | 9 T    |
| 90.000.000.000.000 | t           | 900 T  |

## Usages

`make` method takes 3 aguments: `make(float $value, int $decimals = 1, $lang = null)`


### Service Example

```php

use LaravelReady\ReadableNumbers\Services\ReadableNumbers;

...

$readableNumber = ReadableNumbers::make(123456789); // 123.5 M
$readableNumber = ReadableNumbers::make(-123456789); // -123.5 M

// with more decimals
$readableNumber = ReadableNumbers::make(123456789, 2); // 123.46 M

// with target language (default is english)
$readableNumber = ReadableNumbers::make(123456789, 2, 'tr'); // 123.46 Mn
$readableNumber = ReadableNumbers::make(123456789, 3, 'ja'); // 123.457 億
$readableNumber = ReadableNumbers::make(123456789, 4, 'de'); // 123.4568 Mio.

```

### Directive Example

There is only one directive: `@readableNumber()`, again takes three arguments: `@readableNumber(float $value, int $decimals = 1, $lang = null)`. If you use a multi-language system, you should remember to directives are cached. So, you should pass decimal count and language.


```html

...

<span>
    @readableNumber(123456789, 1, app()->getLocale())
</span>

...

<span class="view-counter">
    <i class="icon icon-eye"></i>

    Viewed @readableNumber($blogPost->views, 1, app()->getLocale()) times
</span>

```

## Languages

Supported languages are listed [here](lang/) and reference are used in [unicode.org](https://www.unicode.org/cldr/cldr-aux/charts/28/verify/numbers/). If you want to add your own language and send PR.

Don't forget to these shortings are depends on a mathematical view.


[badge_downloads]:      https://img.shields.io/packagist/dt/laravel-ready/readable-numbers.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/laravel-ready/readable-numbers.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/laravel-ready/readable-numbers?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/laravel-ready/readable-numbers

