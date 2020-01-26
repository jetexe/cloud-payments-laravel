<?php

namespace AvtoDev\CloudPayments\Responses\Payments\Cards;

use AvtoDev\CloudPayments\Responses\AbstractResponse;

class Payment3DsRequiredResponse extends AbstractResponse
{
    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return (int) ($this->model_fields['TransactionId'] ?? 0);
    }

    /**
     * @return string
     */
    public function getPaReq(): string
    {
        return $this->model_fields['PaReq'] ?? '';
    }

    /**
     * @return string
     */
    public function getAcsUri(): string
    {
        return $this->model_fields['AcsUrl'] ?? '';
    }
}
