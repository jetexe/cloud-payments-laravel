<?php

namespace AvtoDev\CloudPayments\Requests\Subscriptions;

use AvtoDev\CloudPayments\References\Currency;
use AvtoDev\CloudPayments\References\Interval;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#sozdanie-podpiski-na-rekurrentnye-platezhi
 */
class SubscriptionsCreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var string
     */
    protected $token;

    /**
     * Required.
     *
     * @var string
     */
    protected $account_id;

    /**
     * Required.
     *
     * @var string
     */
    protected $description;

    /**
     * Required.
     *
     * @var string
     */
    protected $email;

    /**
     * Required.
     *
     * @var float
     */
    protected $amount;

    /**
     * Required.
     *
     * @see Currency
     *
     * @var string
     */
    protected $currency;

    /**
     * Required.
     *
     * @var bool
     */
    protected $require_confirmation;

    /**
     * Required.
     *
     * @var Carbon
     */
    protected $start_date;

    /**
     * Required.
     *
     * @see Interval
     *
     * @var string
     */
    protected $interval;

    /**
     * Required.
     *
     * @var int
     */
    protected $period;

    /**
     * @var int
     */
    protected $max_periods;

    /**
     * @var string
     */
    protected $customer_receipt;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setToken(string $token): SubscriptionsCreateRequestBuilder
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->account_id;
    }

    /**
     * @param string $account_id
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setAccountId(string $account_id): SubscriptionsCreateRequestBuilder
    {
        $this->account_id = $account_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setDescription(string $description): SubscriptionsCreateRequestBuilder
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setEmail(string $email): SubscriptionsCreateRequestBuilder
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setAmount(float $amount): SubscriptionsCreateRequestBuilder
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setCurrency(string $currency): SubscriptionsCreateRequestBuilder
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequireConfirmation(): bool
    {
        return $this->require_confirmation;
    }

    /**
     * @param bool $require_confirmation
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setRequireConfirmation(bool $require_confirmation): SubscriptionsCreateRequestBuilder
    {
        $this->require_confirmation = $require_confirmation;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    /**
     * @param Carbon $start_date
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setStartDate(Carbon $start_date): SubscriptionsCreateRequestBuilder
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setInterval(string $interval): SubscriptionsCreateRequestBuilder
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @param int $period
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setPeriod(int $period): SubscriptionsCreateRequestBuilder
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPeriods(): int
    {
        return $this->max_periods;
    }

    /**
     * @param int $max_periods
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setMaxPeriods(int $max_periods): SubscriptionsCreateRequestBuilder
    {
        $this->max_periods = $max_periods;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerReceipt(): string
    {
        return $this->customer_receipt;
    }

    /**
     * @param string $customer_receipt
     *
     * @return SubscriptionsCreateRequestBuilder
     */
    public function setCustomerReceipt(string $customer_receipt): SubscriptionsCreateRequestBuilder
    {
        $this->customer_receipt = $customer_receipt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {
        return [
            'Token'               => $this->token,
            'AccountId'           => $this->account_id,
            'Description'         => $this->description,
            'Email'               => $this->email,
            'Amount'              => $this->amount,
            'Currency'            => $this->currency,
            'RequireConfirmation' => $this->require_confirmation,
            'StartDate'           => $this->start_date->toRfc3339String(),
            'Interval'            => $this->interval,
            'Period'              => $this->period,
            'MaxPeriods'          => $this->max_periods,
            'CustomerReceipt'     => $this->customer_receipt,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/subscriptions/create');
    }
}
