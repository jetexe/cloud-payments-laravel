<?php

namespace AvtoDev\CloudPayments\Requests\Subscriptions;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;

/**
 * @see https://developers.cloudpayments.ru/#izmenenie-podpiski-na-rekurrentnye-platezhi
 */
class SubscriptionsUpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Required.
     *
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @see Currency
     *
     * @var string
     */
    protected $currency;

    /**
     * @var bool
     */
    protected $require_confirmation;

    /**
     * @var Carbon
     */
    protected $start_date;

    /**
     * @see Interval
     *
     * @var string
     */
    protected $interval;

    /**
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
     * Required.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Required.
     *
     * @param string $id
     *
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setId(string $id): SubscriptionsUpdateRequestBuilder
    {
        $this->id = $id;

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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setDescription(string $description): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setEmail(string $email): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setAmount(float $amount): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setCurrency(string $currency): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setRequireConfirmation(bool $require_confirmation): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setStartDate(Carbon $start_date): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setInterval(string $interval): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setPeriod(int $period): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setMaxPeriods(int $max_periods): SubscriptionsUpdateRequestBuilder
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
     * @return SubscriptionsUpdateRequestBuilder
     */
    public function setCustomerReceipt(string $customer_receipt): SubscriptionsUpdateRequestBuilder
    {
        $this->customer_receipt = $customer_receipt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {
        return \array_filter([
            'Id'                  => $this->id,
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
        ], static function ($value) { return $value === null; });
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/subscriptions/update');
    }
}
