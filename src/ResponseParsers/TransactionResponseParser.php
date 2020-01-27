<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\ResponseParsers;

use AvtoDev\CloudPayments\Responses\ResponseInterface;
use AvtoDev\CloudPayments\Responses\Payments\PaymentFailedResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;

class TransactionResponseParser
{
    /**
     * @param array $options
     *
     * @return PaymentSuccessResponse|Payment3DsRequiredResponse|PaymentFailedResponse
     */
    public static function parse(array $options): ResponseInterface
    {
        if ($options['Success'] === false && $options['Message'] === null && isset($options['Model']['PaReq'])) {
            $payment_3ds = new Payment3DsRequiredResponse;

            $payment_3ds->setSuccess(false);
            $payment_3ds->setModel($options['Model']);

            return $payment_3ds;
        }

        if ($options['Success'] === false && isset($options['Model']['ReasonCode'])) {
            return (new PaymentFailedResponse)->setSuccess(false)->setModel($options['Model']);
        }

        $success_response = new PaymentSuccessResponse;

        return $success_response->setModel($options['model'])->setSuccess(true);
    }
}
