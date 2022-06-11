<?php

namespace Ibnuhalimm\LaravelMidtrans;

use Ibnuhalimm\LaravelMidtrans\Facades\Midtrans;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-midtrans.php'),
            ], 'laravel-midtrans-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-midtrans');

        $this->app->bind(ConfigRepository::class, function () {
            return new ConfigRepository($this->app['config']['laravel-midtrans']);
        });

        // Register the main class to use with the facade
        $this->app->singleton(Midtrans::class, function (Application $app) {
            return new Service(
                $app->make(ConfigRepository::class)
            );
        });
    }
}
