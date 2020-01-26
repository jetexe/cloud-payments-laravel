<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\Requests\Tokens;

use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use AvtoDev\CloudPayments\Requests\Traits\HasReceipt;
use AvtoDev\CloudPayments\Requests\Traits\PaymentRequestTrait;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @see https://developers.cloudpayments.ru/#oplata-po-tokenu-rekarring
 */
class TokensAuthRequestBuilder extends AbstractRequestBuilder
{
    use PaymentRequestTrait, HasReceipt;

    /**
     * Required.
     *
     * @var string
     */
    protected $token;

    /**
     * Required.
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequestParams(): array
    {
        $this->json_data = \array_merge($this->json_data, $this->getRequestParams());

        return \array_merge($this->getCommonPaymentParams(), [
            'Token' => $this->token,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    protected function getUti(): UriInterface
    {
        return new Uri('/tokens/auth');
    }
}
