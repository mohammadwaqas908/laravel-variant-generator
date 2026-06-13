<?php

namespace Vendor\VariantGenerator\Contracts;

use Closure;
use Illuminate\Support\Collection;

interface VariantGeneratorInterface
{
    /**
     * Set the attributes for variant generation.
     *
     * @param  array<string, array<int, mixed>>  $attributes
     */
    public function attributes(array $attributes): static;

    /**
     * Add exclusion rules.
     *
     * @param  array<int, array<string, mixed>>  $exclusions
     */
    public function exclude(array $exclusions): static;

    /**
     * Set a custom formatting closure.
     */
    public function format(Closure $formatter): static;

    /**
     * Set a SKU generation closure.
     */
    public function sku(Closure $skuGenerator): static;

    /**
     * Generate the variants as an array.
     *
     * @return array<int, mixed>
     */
    public function generate(): array;

    /**
     * Generate the variants as a Collection.
     *
     * @return Collection<int, mixed>
     */
    public function generateAsCollection(): Collection;
}
