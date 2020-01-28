<?php

declare(strict_types = 1);

namespace Unit\Requests\Payments;

use AvtoDev\CloudPayments\Requests\Payments\PaymentsConfirmRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use Unit\Requests\AbstractRequestBuilderTest;

/**
 * @coversDefaultClass \AvtoDev\CloudPayments\Requests\Payments\PaymentsConfirmRequestBuilder
 */
class PaymentsConfirmRequestBuilderTest extends AbstractRequestBuilderTest
{
    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * @var PaymentsConfirmRequestBuilder
     */
    protected $request_builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->uri = new Uri('https://api.cloudpayments.ru/payments/confirm');
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestBuilder(): PaymentsConfirmRequestBuilder
    {
        return new PaymentsConfirmRequestBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return $this->uri;
    }
}
