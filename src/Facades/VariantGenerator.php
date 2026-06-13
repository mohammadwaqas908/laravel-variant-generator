<?php

namespace Waqassiwag\VariantGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Waqassiwag\VariantGenerator\VariantGenerator attributes(array $attributes)
 * @method static \Waqassiwag\VariantGenerator\VariantGenerator exclude(array $exclusions)
 * @method static \Waqassiwag\VariantGenerator\VariantGenerator format(\Closure $formatter)
 * @method static \Waqassiwag\VariantGenerator\VariantGenerator sku(\Closure $skuGenerator)
 * @method static array generate()
 * @method static \Illuminate\Support\Collection generateAsCollection()
 *
 * @see \Waqassiwag\VariantGenerator\VariantGenerator
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
