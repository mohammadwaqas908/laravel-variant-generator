<?php

namespace Waqassiwag\VariantGenerator\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Waqassiwag\VariantGenerator\Facades\VariantGenerator;
use Waqassiwag\VariantGenerator\VariantGeneratorServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            VariantGeneratorServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'VariantGenerator' => VariantGenerator::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
