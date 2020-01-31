<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\ResponseParsers;

use AvtoDev\CloudPayments\ResponseParsers\SubscriptionResponseParser;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\ResponseParsers\SubscriptionResponseParser
 */
class SubscriptionResponseParserTest extends AbstractUnitTestCase
{
    public function testHasModelResponse(): void
    {
        $response = SubscriptionResponseParser::parse([
            'Model'   => ['some'],
            'Success' => true,
            'Message' => null,
        ]);
        $this->assertSame(['some'], $response->getModel());
    }

    public function testFailed(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        SubscriptionResponseParser::parse([]);
    }
}
