<?php

use Illuminate\Support\Collection;
use Vendor\VariantGenerator\Facades\VariantGenerator;

it('generates variants using facade', function () {
    $attributes = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['S', 'M'],
    ];

    $variants = VariantGenerator::make($attributes)->generate();

    expect($variants)->toHaveCount(4)
        ->and($variants[0])->toBe(['Color' => 'Red', 'Size' => 'S'])
        ->and($variants[3])->toBe(['Color' => 'Blue', 'Size' => 'M']);
});

it('can exclude specific variants', function () {
    $attributes = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['S', 'M'],
    ];

    $variants = VariantGenerator::make($attributes)
        ->exclude([
            ['Color' => 'Red', 'Size' => 'S'],
            ['Color' => 'Blue', 'Size' => 'M'],
        ])
        ->generate();

    expect($variants)->toHaveCount(2)
        ->and($variants[0])->toBe(['Color' => 'Red', 'Size' => 'M'])
        ->and($variants[1])->toBe(['Color' => 'Blue', 'Size' => 'S']);
});

it('can format variants', function () {
    $attributes = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['S'],
    ];

    $variants = VariantGenerator::make($attributes)
        ->format(function ($variant) {
            return implode('-', $variant);
        })
        ->generate();

    expect($variants)->toBe([
        'Red-S',
        'Blue-S',
    ]);
});

it('can generate SKUs for variants', function () {
    $attributes = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['Small', 'Medium'],
    ];

    $variants = VariantGenerator::make($attributes)
        ->sku(function ($variant) {
            return strtoupper(substr($variant['Color'], 0, 3).substr($variant['Size'], 0, 1));
        })
        ->generate();

    expect($variants[0])->toBe([
        'attributes' => ['Color' => 'Red', 'Size' => 'Small'],
        'sku' => 'REDS',
    ])->and($variants[1]['sku'])->toBe('REDM')
        ->and($variants[2]['sku'])->toBe('BLUS')
        ->and($variants[3]['sku'])->toBe('BLUM');
});

it('can return a collection', function () {
    $attributes = [
        'Color' => ['Red'],
        'Size' => ['S'],
    ];

    $variants = VariantGenerator::make($attributes)->generateAsCollection();

    expect($variants)->toBeInstanceOf(Collection::class)
        ->and($variants->first())->toBe(['Color' => 'Red', 'Size' => 'S']);
});

it('supports fluent api chaining completely', function () {
    $attributes = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['S', 'L'],
    ];

    $variants = VariantGenerator::make($attributes)
        ->exclude([['Color' => 'Blue', 'Size' => 'L']])
        ->sku(fn ($v) => strtoupper($v['Color'].$v['Size']))
        ->format(function ($v, $processed) {
            return $processed['sku'].'-TEST';
        })
        ->generate();

    expect($variants)->toHaveCount(3)
        ->and($variants)->toBe([
            'REDS-TEST',
            'REDL-TEST',
            'BLUES-TEST',
        ]);
});
