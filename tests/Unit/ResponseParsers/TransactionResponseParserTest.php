<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\ResponseParsers;

use AvtoDev\CloudPayments\ResponseParsers\TransactionResponseParser;
use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentFailedResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\ResponseParsers\TransactionResponseParser
 */
class TransactionResponseParserTest extends AbstractUnitTestCase
{
    public function testParse3ds()
    {
        $model    = ['TransactionId' => 123, 'PaReq' => 'Some'];
        $response = TransactionResponseParser::parse(['Model' => $model, 'Success' => false, 'Message' => null]);
        $this->assertInstanceOf(Payment3DsRequiredResponse::class, $response);

        $this->assertSame($model, $response->getModel());
    }

    public function testPaymentFailedResponse()
    {
        $model    = ['ReasonCode' => 123];
        $response = TransactionResponseParser::parse(['Model' => $model, 'Success' => false, 'Message' => null]);
        $this->assertInstanceOf(PaymentFailedResponse::class, $response);

        $this->assertSame($model, $response->getModel());
    }

    public function testPaymentSuccessResponse()
    {
        $model    = [];
        $response = TransactionResponseParser::parse(['Model' => $model, 'Success' => true, 'Message' => null]);
        $this->assertInstanceOf(PaymentSuccessResponse::class, $response);

        $this->assertSame($model, $response->getModel());
    }

    public function testParseFailed()
    {
        $this->expectException(\InvalidArgumentException::class);
        TransactionResponseParser::parse([]);
    }
}
