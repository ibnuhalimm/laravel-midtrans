<?php

namespace Ibnuhalimm\LaravelMidtrans\Exceptions;

use Exception;
use Ibnuhalimm\LaravelMidtrans\Extractor;

class ErrorResponse extends Exception
{
    public static function throwError(Exception $e)
    {
        $statusMessage = (new Extractor)->getApiResponseMessage($e->getMessage());
        return new static($statusMessage, $e->getCode());
    }
}