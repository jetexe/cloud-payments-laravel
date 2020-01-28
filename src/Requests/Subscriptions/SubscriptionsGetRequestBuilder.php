<?php

namespace AvtoDev\CloudPayments\Requests\Subscriptions;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;

/**
 * @see https://developers.cloudpayments.ru/#zapros-informatsii-o-podpiske
 */
class SubscriptionsGetRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var string
     */
    protected $id;

    protected function getRequestParams(): array
    {
        return [
            'Id' => $this->id,
        ];
    }

    protected function getUri(): UriInterface
    {
        return new Uri('/subscriptions/get');
    }
}
