<?php

declare(strict_types = 1);

namespace Unit\Requests;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;
use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use Tarampampam\Wrappers\Json;

/**
 * @coversDefaultClass \AvtoDev\CloudPayments\Requests\AbstractRequestBuilder
 */
class AbstractRequestTest extends AbstractUnitTestCase
{
    /**
     * @var AbstractRequestBuilder
     */
    protected $request_builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->request_builder = new class extends AbstractRequestBuilder {
            public $uri    = 'test/uri';

            public $params = [
                'foo' => 'bar',
            ];

            protected function getRequestParams(): array
            {
                return $this->params;
            }

            protected function getUti(): UriInterface
            {
                return new Uri($this->uri);
            }
        };
    }

    /**
     * @covers ::buildRequest
     * @covers ::setRequestId
     * @covers ::getRequestId
     *
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public function testRequestId()
    {
        $this->assertSame('', $this->request_builder->getRequestId());

        $request = $this->request_builder->buildRequest();

        $this->assertFalse($request->hasHeader('X-Request-ID'));

        $request_id = 'some_id';

        $this->request_builder->setRequestId($request_id);

        $this->assertSame($request_id, $this->request_builder->getRequestId());

        $request = $this->request_builder->buildRequest();

        $this->assertSame($request_id, $request->getHeader('X-Request-ID')[0]);
    }

    /**
     * @covers ::buildRequest
     */
    public function testUriResolve()
    {
        $request = $this->request_builder->buildRequest();

        $this->assertSame('https', $request->getUri()->getScheme());
        $this->assertSame('api.cloudpayments.ru', $request->getUri()->getHost());

        $this->request_builder->uri = 'http://example.com/test';

        $request = $this->request_builder->buildRequest();

        $this->assertSame('http', $request->getUri()->getScheme());
        $this->assertSame('example.com', $request->getUri()->getHost());
    }

    /**
     * @covers ::buildRequest
     *
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public function testBuildRequest()
    {
        $request = $this->request_builder->buildRequest();

        $this->assertInstanceOf(RequestInterface::class, $request);

        $this->assertSame($this->request_builder->params, Json::decode((string) $request->getBody()));
        $this->assertSame('application/json', $request->getHeader('Content-Type')[0]);
    }
}
