<?php

namespace AvtoDev\CloudPayments\Requests\Subscriptions;

use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#poisk-podpisok
 */
class SubscriptionsFindRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var string
     */
    protected $account_id;

    /**
     * Required.
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->account_id;
    }

    /**
     * Required.
     *
     * @param string $account_id
     *
     * @return SubscriptionsFindRequestBuilder
     */
    public function setAccountId(string $account_id): SubscriptionsFindRequestBuilder
    {
        $this->account_id = $account_id;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {
        return [
            'accountId' => $this->account_id,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/subscriptions/find');
    }
}
