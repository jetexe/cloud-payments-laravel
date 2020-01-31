<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Resposes\Payments;

use AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\Responses\Payments\Payment3DsRequiredResponse
 */
class Payment3DsRequiredResponseTest extends AbstractUnitTestCase
{
    public function test(): void
    {
        $response = new Payment3DsRequiredResponse;

        $this->assertSame(0, $response->getTransactionId());
        $this->assertSame('', $response->getPaReq());
        $this->assertSame('', $response->getAcsUri());

        $response->setModel([
            'TransactionId' => 123,
            'PaReq'         => 'some req',
            'AcsUrl'        => 'example.com',
        ]);

        $this->assertSame(123, $response->getTransactionId());
        $this->assertSame('some req', $response->getPaReq());
        $this->assertSame('example.com', $response->getAcsUri());
    }
}
