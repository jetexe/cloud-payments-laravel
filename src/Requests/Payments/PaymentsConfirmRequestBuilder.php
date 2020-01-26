<?php

namespace AvtoDev\CloudPayments\Requests\Payments;

use GuzzleHttp\Psr7\Uri;
use Tarampampam\Wrappers\Json;
use Psr\Http\Message\UriInterface;
use AvtoDev\CloudPayments\Requests\Traits\HasReceipt;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException;

/**
 * @see https://developers.cloudpayments.ru/#podtverzhdenie-oplaty
 */
class PaymentsConfirmRequestBuilder extends AbstractRequestBuilder
{
    use HasReceipt;

    /**
     * Required.
     *
     * @var int
     */
    protected $transaction_id;

    /**
     * Required.
     *
     * @var float
     */
    protected $amount;

    /**
     * @var array
     */
    protected $json_data;

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
     * @return PaymentsConfirmRequestBuilder
     */
    public function setTransactionId(int $transaction_id): PaymentsConfirmRequestBuilder
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    /**
     * Required.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Required.
     *
     * @param float $amount
     *
     * @return PaymentsConfirmRequestBuilder
     */
    public function setAmount(float $amount): PaymentsConfirmRequestBuilder
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return array
     */
    public function getJsonData(): array
    {
        return $this->json_data ?? [];
    }

    /**
     * @param array $json_data
     *
     * @return PaymentsConfirmRequestBuilder
     */
    public function setJsonData(array $json_data): PaymentsConfirmRequestBuilder
    {
        $this->json_data = $json_data;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws JsonEncodeDecodeException
     */
    protected function getRequestParams(): array
    {
        $this->json_data = \array_merge($this->json_data, $this->getRequestParams());

        return [
            'TransactionId' => $this->transaction_id,
            'Amount'        => $this->amount,
            'JsonData'      => Json::encode($this->json_data),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUti(): UriInterface
    {
        return new Uri('/payments/confirm');
    }
}
