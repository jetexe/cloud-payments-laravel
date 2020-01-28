<?php

declare(strict_types = 1);

namespace Unit\Requests;

use AvtoDev\CloudPayments\Requests\AbstractRequestBuilder;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;
use Psr\Http\Message\UriInterface;

abstract class AbstractRequestBuilderTest extends AbstractUnitTestCase
{
    /**
     * @return AbstractRequestBuilder
     */
    protected $request_builder;

    public function setUp(): void
    {
        parent::setUp();
        $this->request_builder = $this->getRequestBuilder();
    }

    /**
     * @covers ::getUri
     *
     * @throws \Tarampampam\Wrappers\Exceptions\JsonEncodeDecodeException
     */
    public function testUri()
    {
        $uri = $this->request_builder->buildRequest()->getUri();

        $this->assertSame($uri->getScheme(), $this->getUri()->getScheme());
        $this->assertSame($uri->getHost(), $this->getUri()->getHost());
        $this->assertSame($uri->getPath(), $this->getUri()->getPath());
        $this->assertEquals($uri, $this->getUri());
    }

    abstract protected function getUri(): UriInterface;

    /**
     * @return AbstractRequestBuilder
     */
    abstract protected function getRequestBuilder();
}
