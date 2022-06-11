<?php

namespace Ibnuhalimm\LaravelMidtrans\Exceptions;

use Exception;

class CouldNotSendRequest extends Exception
{
    public static function invalidStatusName()
    {
        return new static('The status was invalid.');
    }
}