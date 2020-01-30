<?php

declare(strict_types = 1);

namespace Unit\Requests\ApplePay;

use AvtoDev\CloudPayments\Requests\ApplePay\ApplePayStartSessionRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use Tarampampam\Wrappers\Json;
use AvtoDev\Tests\Unit\Requests\AbstractRequestBuilderTest;

/**
 * @coversDefaultClass \AvtoDev\CloudPayments\Requests\ApplePay\ApplePayStartSessionRequestBuilder
 */
class ApplePayStartSessionRequestBuilderTest extends AbstractRequestBuilderTest
{
    /**
     * @var ApplePayStartSessionRequestBuilder
     */
    protected $request_builder;

    /**
     * @covers ::setValidationUrl
     * @covers ::getValidationUrl
     * @covers ::getRequestParams
     */
    public function testGetters(): void
    {
        $request_builder = $this->getRequestBuilder();
        $request_builder->setValidationUrl($validation_uri = str_random());
        $this->assertSame($validation_uri, $request_builder->getValidationUrl());

        $request = $request_builder->buildRequest();

        $this->assertJsonStringEqualsJsonString(
            Json::encode(['ValidationUrl' => $validation_uri]),
            $request->getBody()->getContents()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestBuilder(): ApplePayStartSessionRequestBuilder
    {
        return new ApplePayStartSessionRequestBuilder;
    }

    protected function getUri(): UriInterface
    {
        return new Uri('https://api.cloudpayments.ru/applepay/startsession');
    }
}
