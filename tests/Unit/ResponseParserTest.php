<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit;

use AvtoDev\CloudPayments\Exceptions\InvalidRequestException;
use AvtoDev\CloudPayments\ResponseParser;
use AvtoDev\CloudPayments\Responses\HasModelResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use GuzzleHttp\Psr7\Response;

/**
 * @covers \AvtoDev\CloudPayments\ResponseParser
 */
class ResponseParserTest extends AbstractUnitTestCase
{
    public function testParseSimpleResponse()
    {
        $response = ResponseParser::parseSimpleResponse(new Response(200, [], '{"Success":true,"Message":null}'));
        $this->assertTrue($response->isSuccess());
    }

    public function testParsePaymentResponse()
    {
        $response = ResponseParser::parsePaymentResponse(
            new Response(200, [], '{"Success":true,"Message":null,"Model":{}}')
        );
        $this->assertInstanceOf(PaymentSuccessResponse::class, $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testParseSubscriptionResponse()
    {
        $response = ResponseParser::parseSubscriptionResponse(
            new Response(200, [], '{"Success":true,"Message":null,"Model":{}}')
        );
        $this->assertInstanceOf(HasModelResponse::class, $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testFailed()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('Exception message');
        ResponseParser::parseSimpleResponse(new Response(200, [], '{"Success":false,"Message":"Exception message"}'));
    }
}
