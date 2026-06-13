<?php

namespace Vendor\VariantGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Vendor\VariantGenerator\VariantGenerator attributes(array $attributes)
 * @method static \Vendor\VariantGenerator\VariantGenerator exclude(array $exclusions)
 * @method static \Vendor\VariantGenerator\VariantGenerator format(\Closure $formatter)
 * @method static \Vendor\VariantGenerator\VariantGenerator sku(\Closure $skuGenerator)
 * @method static array generate()
 * @method static \Illuminate\Support\Collection generateAsCollection()
 *
 * @see \Vendor\VariantGenerator\VariantGenerator
 */
class VariantGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'variant-generator';
    }
}
