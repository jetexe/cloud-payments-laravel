<?php

namespace AvtoDev\CloudPayments\Responses\Payments;

use AvtoDev\CloudPayments\Responses\HasModelResponse;

class Payment3DsRequiredResponse extends HasModelResponse
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
