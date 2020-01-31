<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\ResponseParsers;

use AvtoDev\CloudPayments\ResponseParsers\SimpleResponseParser;
use AvtoDev\CloudPayments\Responses\SimpleResponse;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\ResponseParsers\SimpleResponseParser
 */
class SimpleResponseParserTest extends AbstractUnitTestCase
{
    public function testParse()
    {
        $response = SimpleResponseParser::parse([
            'Success' => true,
            'Message' => 'some',
        ]);
        $this->assertInstanceOf(SimpleResponse::class, $response);

        $this->assertSame('some', $response->getMessage());
        $this->assertTrue($response->isSuccess());
    }

    public function testParseFailed(): void
    {
        $response = SimpleResponseParser::parse([]);
        $this->assertFalse($response->isSuccess());
    }
}
