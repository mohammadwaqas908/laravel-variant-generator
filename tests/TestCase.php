<?php

namespace Vendor\VariantGenerator\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Vendor\VariantGenerator\Facades\VariantGenerator;
use Vendor\VariantGenerator\VariantGeneratorServiceProvider;

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
