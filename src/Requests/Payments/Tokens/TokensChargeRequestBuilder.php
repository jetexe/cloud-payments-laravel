<?php

namespace AvtoDev\CloudPayments\Requests\Payments\Tokens;

use AvtoDev\CloudPayments\Requests\Payments\Tokens\TokensAuthRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#oplata-po-tokenu-rekarring
 */
class TokensChargeRequestBuilder extends TokensAuthRequestBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/payments/tokens/charge');
    }
}
