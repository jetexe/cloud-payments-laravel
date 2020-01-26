<?php

namespace AvtoDev\CloudPayments\Requests\Cards;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#oplata-po-kriptogramme
 */
class CardsChargeRequestFactory extends CardsAuthRequestBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getUti(): UriInterface
    {
        return new Uri('cards/charge');
    }
}
