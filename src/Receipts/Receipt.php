<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\Receipts;

use AvtoDev\CloudPayments\References\TaxationSystem;

class Receipt
{
    /**
     * @var array|Item[]|array<Item>
     */
    protected $items = [];

    /**
     * @var string
     */
    protected $calculation_place;

    /**
     * @see TaxationSystem
     *
     * @var int
     */
    protected $taxation_system;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * Strict accountability form.
     *
     * @var bool
     */
    protected $is_bso = false;

    /**
     * @var float
     */
    protected $electronic_amount;

    /**
     * @var float
     */
    protected $advance_payment_amount;

    /**
     * @var float
     */
    protected $credit_amount;

    /**
     * @var float
     */
    protected $provision_amount;

    /**
     * @param array|Item[]|array<Item> $items
     *
     * @return Receipt
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param string $calculation_place
     *
     * @return Receipt
     */
    public function setCalculationPlace(string $calculation_place): self
    {
        $this->calculation_place = $calculation_place;

        return $this;
    }

    /**
     * @param int $taxation_system
     *
     * @return Receipt
     * @see TaxationSystem
     *
     */
    public function setTaxationSystem(int $taxation_system): self
    {
        $this->taxation_system = $taxation_system;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return Receipt
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $phone
     *
     * @return Receipt
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param bool $is_bso
     *
     * @return Receipt
     */
    public function setIsBso(bool $is_bso): self
    {
        $this->is_bso = $is_bso;

        return $this;
    }

    /**
     * @param float $electronic_amount
     *
     * @return Receipt
     */
    public function setElectronicAmount(float $electronic_amount): self
    {
        $this->electronic_amount = $electronic_amount;

        return $this;
    }

    /**
     * @param float $advance_payment_amount
     *
     * @return Receipt
     */
    public function setAdvancePaymentAmount(float $advance_payment_amount): self
    {
        $this->advance_payment_amount = $advance_payment_amount;

        return $this;
    }

    /**
     * @param float $credit_amount
     *
     * @return Receipt
     */
    public function setCreditAmount(float $credit_amount): self
    {
        $this->credit_amount = $credit_amount;

        return $this;
    }

    /**
     * @param float $provision_amount
     *
     * @return Receipt
     */
    public function setProvisionAmount(float $provision_amount): self
    {
        $this->provision_amount = $provision_amount;

        return $this;
    }

    /**
     * @param Item $item
     *
     * @return Receipt
     */
    public function addItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $receipt_items = [];
        foreach ($this->items as $receipt_item) {
            if ($receipt_item instanceof Item) {
                $receipt_items[] = $receipt_item->toArray();
            }
        }

        return \array_filter([
            'Items'            => $receipt_items,
            'calculationPlace' => $this->calculation_place,
            'taxationSystem'   => $this->taxation_system,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'isBso'            => $this->is_bso,
            'amounts'          => [
                'electronic'     => \number_format((float) $this->electronic_amount, 2, '.', ''),
                'advancePayment' => \number_format((float) $this->advance_payment_amount, 2, '.', ''),
                'credit'         => \number_format((float) $this->credit_amount, 2, '.', ''),
                'provision'      => \number_format((float) $this->provision_amount, 2, '.', ''),
            ],
        ]);
    }
}
