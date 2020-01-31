<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Resposes;

use AvtoDev\CloudPayments\Responses\AbstractResponse;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\Responses\AbstractResponse
 */
class AbstractResponseTest extends AbstractUnitTestCase
{
    /**
     * @var AbstractResponse
     */
    protected $response;

    public function setUp(): void
    {
        parent::setUp();
        $this->response = new class extends AbstractResponse {
        };
    }

    public function testIsSuccess()
    {
        $this->assertFalse($this->response->isSuccess());
        $this->response->setSuccess(false);
        $this->assertFalse($this->response->isSuccess());
        $this->response->setSuccess(true);
        $this->assertTrue($this->response->isSuccess());
    }

    public function testMessage()
    {
        $this->assertNull($this->response->getMessage());
        $this->response->setMessage('some');
        $this->assertSame('some', $this->response->getMessage());
    }
}
