<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\ResponseParsers;

use AvtoDev\CloudPayments\Responses\ResponseInterface;

interface ResponseParserInterface
{
    /**
     * @param array $options
     *
     * @return ResponseInterface
     */
    public static function parse(array $options);
}
