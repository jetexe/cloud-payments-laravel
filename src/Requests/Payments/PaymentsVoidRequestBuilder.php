<?php

namespace AvtoDev\CloudPayments\Requests\Payments;

use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

class PaymentsVoidRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var int
     */
    protected $transaction_id;

    /**
     * Required.
     *
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transaction_id;
    }

    /**
     * Required.
     *
     * @param int $transaction_id
     *
     * @return PaymentsVoidRequestBuilder
     */
    public function setTransactionId(int $transaction_id): PaymentsVoidRequestBuilder
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {

        return [
            'TransactionId' => $this->transaction_id,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/payments/void');
    }
}
