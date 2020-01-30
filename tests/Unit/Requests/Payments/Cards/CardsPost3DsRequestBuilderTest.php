<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Requests\Payments\Cards;

use AvtoDev\CloudPayments\Requests\Payments\Cards\CardsPost3DsRequestBuilder;
use AvtoDev\Tests\Unit\Requests\AbstractRequestBuilderTest;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @coversDefaultClass \AvtoDev\CloudPayments\Requests\Payments\Cards\CardsPost3DsRequestBuilder
 */
class CardsPost3DsRequestBuilderTest extends AbstractRequestBuilderTest
{
    /**
     * @var CardsPost3DsRequestBuilder
     */
    protected $request_builder;

    public function testTransactionId(): void
    {
        $this->assertSame('', $this->request_builder->buildRequest()->getBody()->getContents());

        $this->request_builder->setTransactionId(1);
        $this->assertSame(1, $this->request_builder->getTransactionId());

        $this->assertSame('{"TransactionId":1}', $this->request_builder->buildRequest()->getBody()->getContents());
    }

    public function testPaRes(): void
    {
        $this->assertSame('', $this->request_builder->buildRequest()->getBody()->getContents());

        $this->request_builder->setPaRes('some');
        $this->assertSame('some', $this->request_builder->getPaRes());

        $this->assertSame('{"PaRes":"some"}', $this->request_builder->buildRequest()->getBody()->getContents());
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequestBuilder(): CardsPost3DsRequestBuilder
    {
        return new CardsPost3DsRequestBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(): UriInterface
    {
        return new Uri('https://api.cloudpayments.ru/payments/cards/post3ds');
    }
}