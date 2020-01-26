<?php

namespace AvtoDev\CloudPayments;

use AvtoDev\CloudPayments\Exceptions\InvalidRequestException;
use AvtoDev\CloudPayments\Responses\Payments\Cards\Payment3DsRequiredResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\CloudPayments\Responses\TestResponse;
use Psr\Http\Message\ResponseInterface;
use Tarampampam\Wrappers\Json;

class ResponseParser
{
    public static function parseTestResponse(ResponseInterface $response): TestResponse
    {
        /** @var array $options */
        $options = Json::decode($response->getBody()->getContents());
        static::checkError($options);

        $test_response = new TestResponse;

        $test_response->setSuccess($options['Success']);
        $test_response->setMessage($options['Message']);

        return $test_response;
    }

    public static function parsePaymentCardAuthResponse(ResponseInterface $response)
    {
        /** @var array $options */
        $options = Json::decode($response->getBody()->getContents());
        static::checkError($options);

        if ($options['Success'] === false && $options['Message'] === null && isset($options['Model']['PaReq'])) {
            $payment_3ds = new Payment3DsRequiredResponse;

            $payment_3ds->setSuccess(false);
            $payment_3ds->setModel($options['Model']);

            return $payment_3ds;
        }

        $success_response = new PaymentSuccessResponse;

        return $success_response->setModel($options['model'])->setSuccess(true);
    }

    /**
     * @param array $options
     */
    protected static function checkError(array $options): void
    {
        if ($options['Success'] === false && $options['Message'] !== null && ! isset($options['Model'])) {
            throw new InvalidRequestException($options['Message']);
        }
    }
}
