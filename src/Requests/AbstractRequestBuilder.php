<?php

declare(strict_types = 1);

namespace AvtoDev\CloudPayments\Requests;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;
use Tarampampam\Wrappers\Json;
use GuzzleHttp\Psr7\UriResolver;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\stream_for;

abstract class AbstractRequestBuilder
{
    private const BASE_URI = 'https://api.cloudpayments.ru';

    /**
     * @var string
     */
    protected $request_id = '';

    /**
     *
     * @see https://developers.cloudpayments.ru/#idempotentnost-api
     *
     * @param string $request_id
     *
     * @return $this
     */
    public function setRequestId(string $request_id): self
    {
        $this->request_id = $request_id;

        return $this;
    }

    /**
     * @return RequestInterface
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public function buildRequest(): RequestInterface
    {
        $uri = $this->getUti();

        if ($uri->getHost() === '') {
            $uri = UriResolver::resolve(new Uri(self::BASE_URI), $uri);
        }

        $request = new Request('POST', $uri);

        if ($this->request_id !== '') {
            $request = $request->withHeader('X-Request-ID', $this->request_id);
        }

        /** @var RequestInterface $request */
        $request = $request->withHeader('Content-Type', 'application/json')
            ->withBody(stream_for(Json::encode($this->getRequestParams())));

        return $request;
    }

    /**
     * Returns request parameters.
     *
     * @return array
     */
    abstract protected function getRequestParams(): array;

    /**
     * @return UriInterface
     */
    abstract protected function getUti(): UriInterface;
}