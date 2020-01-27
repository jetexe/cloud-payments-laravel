<?php

namespace AvtoDev\CloudPayments;

use AvtoDev\CloudPayments\ResponseParsers\SimpleResponseParser;
use AvtoDev\CloudPayments\Responses\Payments\PaymentFailedResponse;
use Tarampampam\Wrappers\Json;
use Psr\Http\Message\ResponseInterface;
use AvtoDev\CloudPayments\Responses\SimpleResponse;
use AvtoDev\CloudPayments\Exceptions\InvalidRequestException;
use AvtoDev\CloudPayments\ResponseParsers\TransactionResponseParser;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;

class ResponseParser
{
    /**
     * @param ResponseInterface $response
     *
     * @return SimpleResponse
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public static function parseSimpleResponse(ResponseInterface $response): SimpleResponse
    {
        $options = static::parseResponse($response);

        return SimpleResponseParser::parse($options);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return PaymentSuccessResponse|Payment3DsRequiredResponse|PaymentFailedResponse
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public static function parsePaymentResponse(ResponseInterface $response)
    {
        $options = static::parseResponse($response);

        return TransactionResponseParser::parse($options);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    protected static function parseResponse(ResponseInterface $response): array
    {
        $options = (array) Json::decode($response->getBody()->getContents());
        if ($options['Success'] === false && $options['Message'] !== null && ! isset($options['Model'])) {
            throw new InvalidRequestException($options['Message']);
        }

        return $options;
    }
}
