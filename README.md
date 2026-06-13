# laravel-variant-generator
A powerful and fluent Laravel package to generate all possible product variants (Cartesian Product) from a set of attributes, with support for custom formatting, SKUs, and exclusions.
# Laravel Variant Generator

A production-ready open-source Laravel package to generate all possible product variants (Cartesian Product) from a set of attributes and their values.

[![Run Tests](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml/badge.svg)](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Requirements

* PHP 8.1+
* Laravel 10.0+ / 11.0+ / 12.0+

## Installation

You can install the package via composer:

```bash
composer require waqassiwag/laravel-variant-generator
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="variant-generator-config"
```

## Usage

```php
use Vendor\VariantGenerator\Facades\VariantGenerator;

$attributes = [
    'Color' => ['Red', 'Blue'],
    'Size' => ['S', 'M'],
    'Material' => ['Cotton', 'Polyester']
];

$variants = VariantGenerator::make($attributes)->generate();
```

### Excluding Variants

```php
VariantGenerator::make($attributes)
    ->exclude([
        ['Color' => 'Red', 'Size' => 'S']
    ])
    ->generate();
```

### Formatting Variants

```php
VariantGenerator::make($attributes)
    ->format(function ($variant) {
        return implode('-', $variant);
    })
    ->generate();
```

### Generating SKUs

```php
VariantGenerator::make($attributes)
    ->sku(function ($variant) {
        return strtoupper(
            substr($variant['Color'], 0, 3) . substr($variant['Size'], 0, 1)
        );
    })
    ->generate();
```

### Returning a Collection

```php
VariantGenerator::make($attributes)->generateAsCollection();
```

### Fluent API

```php
VariantGenerator::make($attributes)
    ->exclude([['Color' => 'Red', 'Size' => 'S']])
    ->sku(fn ($v) => strtoupper($v['Color'] . $v['Size']))
    ->format(fn ($v, $processed) => $processed['sku'] . '-TEST')
    ->generate();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
