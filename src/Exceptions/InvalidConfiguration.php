<?php

namespace Ibnuhalimm\LaravelMidtrans\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function missingServerKey()
    {
        return new static('You must specify the Server Key');
    }


    public static function missingClientKey()
    {
        return new static('You must specify the Client Key');
    }


    public static function missingMode()
    {
        return new static('You must specify the Environment Mode');
    }


    public static function invalidModeValue()
    {
        return new static("The Environment Mode value is invalid.");
    }
}