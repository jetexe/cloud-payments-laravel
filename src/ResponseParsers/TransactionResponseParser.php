<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\ResponseParsers;

use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentFailedResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\CloudPayments\Responses\ResponseInterface;

class TransactionResponseParser
{
    /**
     * @param array $options
     *
     * @return PaymentSuccessResponse|Payment3DsRequiredResponse|PaymentFailedResponse
     */
    public static function parse(array $options): ResponseInterface
    {
        $model = $options['Model'] ?? null;

        if ($model === null) {
            throw  new \InvalidArgumentException('Filed "Model" must be set');
        }

        if (isset($model['PaReq'])) {
            $payment_3ds = new Payment3DsRequiredResponse;

            $payment_3ds->setSuccess(false);
            $payment_3ds->setModel($model);

            return $payment_3ds;
        }

        if (isset($model['ReasonCode'])) {
            return (new PaymentFailedResponse)->setSuccess(false)->setModel($model)->setMessage($options['Message']);
        }

        $success_response = new PaymentSuccessResponse;

        return $success_response->setModel($model)->setSuccess($options['Success'])->setMessage($options['Message']);
    }
}
