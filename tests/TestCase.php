<?php

namespace Maplerad\Laravel\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Maplerad\Laravel\MapleradServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            MapleradServiceProvider::class,
        ];
    }
}
