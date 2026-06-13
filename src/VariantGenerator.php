<?php

namespace Waqassiwag\VariantGenerator;

use Closure;
use Illuminate\Support\Collection;
use Waqassiwag\VariantGenerator\Contracts\VariantGeneratorInterface;
use Waqassiwag\VariantGenerator\Services\CartesianProductGenerator;

class VariantGenerator implements VariantGeneratorInterface
{
    /**
     * @var array<string, array<int, mixed>>
     */
    protected array $attributes = [];

    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $exclusions = [];

    protected ?Closure $formatter = null;

    protected ?Closure $skuGenerator = null;

    protected CartesianProductGenerator $generator;

    public function __construct(CartesianProductGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Create a new instance with attributes.
     *
     * @param  array<string, array<int, mixed>>  $attributes
     */
    public static function make(array $attributes = []): static
    {
        return app(static::class)->attributes($attributes);
    }

    public function attributes(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function exclude(array $exclusions): static
    {
        $this->exclusions = array_merge($this->exclusions, $exclusions);

        return $this;
    }

    public function format(Closure $formatter): static
    {
        $this->formatter = $formatter;

        return $this;
    }

    public function sku(Closure $skuGenerator): static
    {
        $this->skuGenerator = $skuGenerator;

        return $this;
    }

    public function generate(): array
    {
        $variants = $this->generator->generate($this->attributes);

        $result = [];

        foreach ($variants as $variant) {
            if ($this->shouldExclude($variant)) {
                continue;
            }

            $processedVariant = $variant;

            if ($this->skuGenerator) {
                $processedVariant = [
                    'attributes' => $variant,
                    'sku' => ($this->skuGenerator)($variant),
                ];
            }

            if ($this->formatter) {
                $processedVariant = ($this->formatter)($variant, $processedVariant);
            }

            $result[] = $processedVariant;
        }

        return $result;
    }

    public function generateAsCollection(): Collection
    {
        return collect($this->generate());
    }

    /**
     * Check if a variant should be excluded.
     *
     * @param  array<string, mixed>  $variant
     */
    protected function shouldExclude(array $variant): bool
    {
        foreach ($this->exclusions as $exclusion) {
            $matches = true;
            foreach ($exclusion as $key => $value) {
                if (! isset($variant[$key]) || $variant[$key] !== $value) {
                    $matches = false;
                    break;
                }
            }

            if ($matches) {
                return true;
            }
        }

        return false;
    }
}
