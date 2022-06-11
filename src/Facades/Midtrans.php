<?php

namespace Ibnuhalimm\LaravelMidtrans\Facades;

use Ibnuhalimm\LaravelMidtrans\Service;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ibnuhalimm\LaravelMidtrans\Service
 * @see \Ibnuhalimm\LaravelMidtrans\Services\Transaction
 *
 * @method static $this setConfig(array $options)
 * @method static string getSnapToken(array $params)
 * @method static string getSnapUrl(array $params)
 * @method static string charge(array $params)
 * @method static mixed transaction(string $id)
 */
class Midtrans extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Service::class;
    }
}
