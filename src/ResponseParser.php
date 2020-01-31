<?php

namespace AvtoDev\CloudPayments;

use AvtoDev\CloudPayments\Exceptions\InvalidRequestException;
use AvtoDev\CloudPayments\ResponseParsers\SimpleResponseParser;
use AvtoDev\CloudPayments\ResponseParsers\SubscriptionResponseParser;
use AvtoDev\CloudPayments\ResponseParsers\TransactionResponseParser;
use AvtoDev\CloudPayments\Responses\HasModelResponse;
use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentFailedResponse;
use AvtoDev\CloudPayments\Responses\Payments\PaymentSuccessResponse;
use AvtoDev\CloudPayments\Responses\SimpleResponse;
use Psr\Http\Message\ResponseInterface;
use Tarampampam\Wrappers\Json;

class ResponseParser
{
    /**
     * @param ResponseInterface $response
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     *
     * @return SimpleResponse
     */
    public static function parseSimpleResponse(ResponseInterface $response): SimpleResponse
    {
        $options = static::parseResponse($response);

        return SimpleResponseParser::parse($options);
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     *
     * @return PaymentSuccessResponse|Payment3DsRequiredResponse|PaymentFailedResponse
     */
    public static function parsePaymentResponse(ResponseInterface $response)
    {
        $options = static::parseResponse($response);

        return TransactionResponseParser::parse($options);
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     *
     * @return HasModelResponse
     */
    public static function parseSubscriptionResponse(ResponseInterface $response): HasModelResponse
    {
        $options = static::parseResponse($response);

        return SubscriptionResponseParser::parse($options);
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws InvalidRequestException
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     *
     * @return array
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
