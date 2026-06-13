# Laravel Variant Generator

A simple and fast Laravel package to generate all possible product variants (Cartesian Product) from your attributes.

[![Run Tests](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml/badge.svg)](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Requirements
* PHP 8.1+
* Laravel 10+ / 11+ / 12+

## Installation

```bash
composer require waqassiwag/laravel-variant-generator
```

## Quick Start

Pass an array of your product attributes to the generator, and it will return all possible combinations.

```php
use Vendor\VariantGenerator\Facades\VariantGenerator;

$attributes = [
    'Color' => ['Red', 'Blue'],
    'Size' => ['S', 'M']
];

$variants = VariantGenerator::make($attributes)->generate();

/*
Output:
[
  ['Color' => 'Red', 'Size' => 'S'],
  ['Color' => 'Red', 'Size' => 'M'],
  ['Color' => 'Blue', 'Size' => 'S'],
  ['Color' => 'Blue', 'Size' => 'M']
]
*/
```

## Advanced Features

You can chain methods to easily exclude certain variants, auto-generate SKUs, or get the result as a Laravel Collection:

```php
$variants = VariantGenerator::make($attributes)
    ->exclude([
        ['Color' => 'Red', 'Size' => 'S'] // Remove this combination
    ])
    ->sku(fn ($variant) => strtoupper($variant['Color'] . $variant['Size'])) // Add SKU like 'REDS'
    ->generateAsCollection(); // Returns a Laravel Collection instead of an array
```

## Testing

```bash
composer test
```

## Support & Security

### Support

- **Issues:** [Open an issue in GitHub](https://github.com/mohammadwaqas908/laravel-variant-generator/issues)

## Credits

- [Muhammad Waqas](https://github.com/mohammadwaqas908)


- **Security:** If you discover any issues, please email `m.waqas7375@gmail.com`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
