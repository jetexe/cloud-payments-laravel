<?php

namespace AvtoDev\CloudPayments\Requests\Tokens;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#oplata-po-tokenu-rekarring
 */
class TokensChargeRequestFactory extends TokensAuthRequestBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getUti(): UriInterface
    {
        return new Uri('/tokens/charge');
    }
}
