<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Requests\Payments\Tokens;

use AvtoDev\CloudPayments\Requests\Payments\Tokens\TokensAuthRequestBuilder;
use AvtoDev\CloudPayments\Requests\Payments\Tokens\TokensChargeRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @coversDefaultClass \AvtoDev\CloudPayments\Requests\Payments\Tokens\TokensChargeRequestBuilder
 */
class TokensChargeRequestBuilderTest extends TokensAuthRequestBuilderTest
{
    /**
     * {@inheritDoc}
     */
    protected function getRequestBuilder(): TokensAuthRequestBuilder
    {
        return new TokensChargeRequestBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('https://api.cloudpayments.ru/payments/tokens/charge');
    }
}