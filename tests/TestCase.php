<?php

namespace Tests;

use Ibnuhalimm\LaravelMidtrans\Facades\Midtrans;
use Ibnuhalimm\LaravelMidtrans\MidtransServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            MidtransServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Midtrans' => Midtrans::class
        ];
    }
}