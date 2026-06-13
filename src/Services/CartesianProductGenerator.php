<?php

namespace Vendor\VariantGenerator\Services;

class CartesianProductGenerator
{
    /**
     * Generate the cartesian product of a multidimensional array.
     *
     * @param  array<string, array<int, mixed>>  $input
     * @return array<int, array<string, mixed>>
     */
    public function generate(array $input): array
    {
        if (empty($input)) {
            return [];
        }

        // Filter out empty arrays and normalize duplicates if necessary
        $filteredInput = [];
        foreach ($input as $key => $values) {
            if (empty($values)) {
                return []; // If any attribute has no values, cartesian product is empty
            }
            // Ensure values are unique and re-index
            $filteredInput[$key] = array_values(array_unique($values, SORT_REGULAR));
        }

        $result = [[]];

        foreach ($filteredInput as $key => $values) {
            $append = [];

            foreach ($result as $product) {
                foreach ($values as $item) {
                    $product[$key] = $item;
                    $append[] = $product;
                }
            }

            $result = $append;
        }

        return $result;
    }
}
