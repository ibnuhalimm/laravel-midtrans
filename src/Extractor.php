<?php

namespace Ibnuhalimm\LaravelMidtrans;

class Extractor
{
    public function getApiResponseMessage(string $exceptionMessage)
    {
        $pattern = '/\{(.*)\}/';
        $regex = preg_match($pattern, $exceptionMessage, $matches);

        $response = [];
        if ($regex) {
            $response = json_decode(str_replace('\\', '', $matches[0]), true);
        }

        return isset($response['status_message'])
            ? $response['status_message']
            : $exceptionMessage;
    }
}