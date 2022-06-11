<?php

namespace Tests;

use Ibnuhalimm\LaravelMidtrans\Exceptions\InvalidConfiguration;
use Ibnuhalimm\LaravelMidtrans\Facades\Midtrans;
use Illuminate\Foundation\Testing\WithFaker;

class ServiceProviderTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_should_be_throw_exception_if_server_key_not_provided()
    {
        $this->app['config']->set('laravel-midtrans.server_key', '');

        $this->expectException(InvalidConfiguration::class);

        Midtrans::transaction($this->faker->uuid())->getDetails();
    }
}