<?php

namespace AvtoDev\CloudPayments\Requests\Subscriptions;

use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#otmena-podpiski-na-rekurrentnye-platezhi
 */
class SubscriptionsCancelRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var string
     */
    protected $id;

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {
        return [
            'Id' => $this->id,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/subscriptions/cancel');
    }
}
