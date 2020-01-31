<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\ResponseParsers;

use AvtoDev\CloudPayments\Responses\HasModelResponse;

class SubscriptionResponseParser implements ResponseParserInterface
{
    /**
     * {@inheritdoc}
     */
    public static function parse(array $options): HasModelResponse
    {
        $model = $options['Model'] ?? null;
        if ($model === null) {
            throw  new \InvalidArgumentException('Filed "Model" must be set');
        }

        return (new HasModelResponse)
            ->setModel($model)
            ->setSuccess($options['Success'])
            ->setMessage($options['Message']);
    }
}
