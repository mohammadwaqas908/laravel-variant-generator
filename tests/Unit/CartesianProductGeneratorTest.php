<?php

use Vendor\VariantGenerator\Services\CartesianProductGenerator;

it('generates empty array for empty input', function () {
    $generator = new CartesianProductGenerator;
    expect($generator->generate([]))->toBe([]);
});

it('generates variants for a single attribute', function () {
    $generator = new CartesianProductGenerator;
    $input = ['Color' => ['Red', 'Blue']];
    $expected = [
        ['Color' => 'Red'],
        ['Color' => 'Blue'],
    ];

    expect($generator->generate($input))->toBe($expected);
});

it('generates variants for multiple attributes', function () {
    $generator = new CartesianProductGenerator;
    $input = [
        'Color' => ['Red', 'Blue'],
        'Size' => ['S', 'M'],
    ];
    $expected = [
        ['Color' => 'Red', 'Size' => 'S'],
        ['Color' => 'Red', 'Size' => 'M'],
        ['Color' => 'Blue', 'Size' => 'S'],
        ['Color' => 'Blue', 'Size' => 'M'],
    ];

    expect($generator->generate($input))->toBe($expected);
});

it('handles duplicate values by ignoring them', function () {
    $generator = new CartesianProductGenerator;
    $input = [
        'Color' => ['Red', 'Red', 'Blue'],
        'Size' => ['S', 'S'],
    ];
    $expected = [
        ['Color' => 'Red', 'Size' => 'S'],
        ['Color' => 'Blue', 'Size' => 'S'],
    ];

    expect($generator->generate($input))->toBe($expected);
});

it('returns empty array if any attribute is empty', function () {
    $generator = new CartesianProductGenerator;
    $input = [
        'Color' => ['Red', 'Blue'],
        'Size' => [],
    ];

    expect($generator->generate($input))->toBe([]);
});
