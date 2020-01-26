<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\Receipts;

use AvtoDev\CloudPayments\References\Vat;
use AvtoDev\CloudPayments\References\PaymentType;
use AvtoDev\CloudPayments\References\PaymentObject;

class Item
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @see Vat
     *
     * @var int|null
     */
    protected $vat;

    /**
     * @see PaymentType
     *
     * @var int
     */
    protected $method;

    /**
     * @see PaymentObject
     *
     * @var int
     */
    protected $object;

    /**
     * @var string
     */
    protected $measurement_unit;

    /**
     * @param string $label
     *
     * @return Item
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param float $price
     *
     * @return Item
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param float $quantity
     *
     * @return Item
     */
    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @param float $amount
     *
     * @return Item
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param int|null $vat
     *
     * @return Item
     */
    public function setVat(?int $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @param int $method
     *
     * @return Item
     * @see PaymentType
     *
     */
    public function setMethod(int $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param int $object
     *
     * @return Item
     */
    public function setObject(int $object): self
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @param string $measurement_unit
     *
     * @return Item
     */
    public function setMeasurementUnit(string $measurement_unit): self
    {
        $this->measurement_unit = $measurement_unit;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return \array_filter([
            'label'           => $this->label,
            'price'           => $this->price,
            'quantity'        => $this->quantity,
            'amount'          => $this->amount,
            'vat'             => $this->vat,
            'method'          => $this->method,
            'object'          => $this->object,
            'measurementUnit' => $this->measurement_unit,
        ]);
    }
}
