<?php

namespace Vendor\VariantGenerator;

use Illuminate\Support\ServiceProvider;
use Vendor\VariantGenerator\Services\CartesianProductGenerator;

class VariantGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/variant-generator.php', 'variant-generator'
        );

        $this->app->singleton(VariantGenerator::class, function ($app) {
            return new VariantGenerator(new CartesianProductGenerator);
        });

        $this->app->bind('variant-generator', function ($app) {
            return $app->make(VariantGenerator::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/variant-generator.php' => config_path('variant-generator.php'),
            ], 'variant-generator-config');
        }
    }
}
