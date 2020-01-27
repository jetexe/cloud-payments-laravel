<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\ResponseParsers;

use AvtoDev\CloudPayments\Responses\SimpleResponse;

class SimpleResponseParser implements ResponseParserInterface
{
    public static function parse(array $options): SimpleResponse
    {
        $test_response = new SimpleResponse;

        $test_response->setSuccess($options['Success']);
        $test_response->setMessage($options['Message']);

        return $test_response;
    }
}
