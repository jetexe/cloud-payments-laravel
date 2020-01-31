<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Resposes\Traits;

use AvtoDev\CloudPayments\Responses\Traits\HasModel;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;

/**
 * @covers \AvtoDev\CloudPayments\Responses\Traits\HasModel
 */
class HasModelTraitTest extends AbstractUnitTestCase
{
    public function testModel()
    {
        $response = new class {
            use HasModel;
        };

        $this->assertNull($response->getModel());

        $response->setModel(['some' => 'val']);

        $this->assertSame(['some' => 'val'], $response->getModel());

        $response->setModel(null);
        $this->assertNull($response->getModel());
    }
}
