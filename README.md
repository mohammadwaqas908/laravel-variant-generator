# Laravel Variant Generator

A fast and fluent Laravel package to generate all possible product variants (Cartesian Product) from a set of attributes.

[![Run Tests](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml/badge.svg)](https://github.com/mohammadwaqas908/laravel-variant-generator/actions/workflows/tests.yml)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Requirements
* PHP 8.1+
* Laravel 10.0+ / 11.0+ / 12.0+

## Installation

```bash
composer require waqassiwag/laravel-variant-generator
```

## Basic Usage

Pass an array of your product attributes to generate all possible combinations.

```php
use Waqassiwag\VariantGenerator\Facades\VariantGenerator;

$attributes = [
    'Color' => ['Red', 'Blue'],
    'Size' => ['S', 'M'],
    'Material' => ['Cotton', 'Polyester']
];

$variants = VariantGenerator::make($attributes)->generate();
```

**Output:**
```php
[
    ['Color' => 'Red', 'Size' => 'S', 'Material' => 'Cotton'],
    ['Color' => 'Red', 'Size' => 'S', 'Material' => 'Polyester'],
    ['Color' => 'Red', 'Size' => 'M', 'Material' => 'Cotton'],
    // ...
]
```

## Advanced Features

### 1. Excluding Variants
Remove specific combinations that you don't want to generate.

```php
VariantGenerator::make($attributes)
    ->exclude([
        ['Color' => 'Red', 'Size' => 'S']
    ])
    ->generate();
```

### 2. Custom Formatting
Modify the output exactly how you need it.

```php
VariantGenerator::make($attributes)
    ->format(function ($variant) {
        return implode('-', $variant);
    })
    ->generate();

// Output: ['Red-S-Cotton', 'Red-S-Polyester', ...]
```

### 3. Generating SKUs
Automatically append a unique SKU to each variant.

```php
VariantGenerator::make($attributes)
    ->sku(function ($variant) {
        return strtoupper(
            substr($variant['Color'], 0, 3) . substr($variant['Size'], 0, 1)
        );
    })
    ->generate();
```

**Output:**
```php
[
    [
        'attributes' => ['Color' => 'Red', 'Size' => 'Small'],
        'sku' => 'REDS'
    ],
    // ...
]
```

### 4. Fluent API
You can chain all these methods together to build complex generation logic cleanly.

```php
VariantGenerator::make($attributes)
    ->exclude([['Color' => 'Red', 'Size' => 'S']])
    ->sku(fn ($variant) => strtoupper(substr($variant['Color'],0,3).substr($variant['Size'],0,1)))
    ->format(fn ($variant, $processed) => $processed['sku'] . '-' . $variant['Material'])
    ->generate();
```

> **Tip:** You can also call `->generateAsCollection()` at the end if you prefer working with a Laravel Collection instead of an array.

## Testing

```bash
composer test
```

## Support & Security

### Support

- **Issues:** [Open an issue in GitHub](https://github.com/mohammadwaqas908/laravel-variant-generator/issues)

- **Security:** If you discover any issues, please email `m.waqas7375@gmail.com`.
## Credits

- [Muhammad Waqas](https://github.com/mohammadwaqas908)



## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
