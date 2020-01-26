<?php

namespace AvtoDev\CloudPayments;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use AvtoDev\CloudPayments\Exceptions\CloudPaymentsRequestException;

class Client
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Client constructor.
     *
     * @param ClientInterface $client
     * @param Config          $config
     */
    public function __construct(ClientInterface $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->send($request, $this->getRequestOptions());
        } catch (GuzzleException $exception) {
            if ($exception instanceof \Exception) {
                throw CloudPaymentsRequestException::wrapException($request, $exception);
            }
            throw  $exception;
        }
    }

    protected function getRequestOptions(): array
    {
        return [
            'auth' => [$this->config->getPublicId(), $this->config->getApiKey()],
        ];
    }

    /**
     * @param array  $options
     * @param Config $config
     *
     * @return static
     */
    public static function factory(Config $config, array $options = [])
    {
        return new static(new GuzzleClient($options), $config);
    }
}
