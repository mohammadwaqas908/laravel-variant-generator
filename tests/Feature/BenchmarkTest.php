<?php

use Vendor\VariantGenerator\Facades\VariantGenerator;

it('can generate a large dataset quickly', function () {
    $attributes = [
        'Color' => ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Purple', 'Orange'],
        'Size' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
        'Material' => ['Cotton', 'Polyester', 'Silk', 'Wool'],
        'Style' => ['Casual', 'Formal', 'Sport', 'Vintage'],
    ];

    $start = microtime(true);

    $variants = VariantGenerator::make($attributes)->generate();

    $end = microtime(true);
    $timeTaken = $end - $start;

    // 8 * 6 * 4 * 4 = 768 variants
    expect($variants)->toHaveCount(768);
    // Ensure it runs in less than 50ms (usually it takes ~1-5ms)
    expect($timeTaken)->toBeLessThan(0.05);
});
