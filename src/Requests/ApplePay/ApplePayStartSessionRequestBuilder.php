<?php

namespace AvtoDev\CloudPayments\Requests\ApplePay;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;

/**
 * @see https://developers.cloudpayments.ru/#zapusk-sessii-dlya-oplaty-cherez-apple-pay
 */
class ApplePayStartSessionRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var string
     */
    protected $validation_url;

    /**
     * @return string
     */
    public function getValidationUrl(): string
    {
        return $this->validation_url;
    }

    /**
     * @param string $validation_url
     *
     * @return ApplePayStartSessionRequestBuilder
     */
    public function setValidationUrl(string $validation_url): ApplePayStartSessionRequestBuilder
    {
        $this->validation_url = $validation_url;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestParams(): array
    {
        return ['ValidationUrl' => $this->validation_url];
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('/applepay/startsession');
    }
}
