<?php

declare(strict_types = 1);

namespace AvtoDev\Tests\Unit\Requests\Traits;

use AvtoDev\CloudPayments\Requests\Traits\PaymentRequestTrait;
use AvtoDev\Tests\Unit\AbstractUnitTestCase;
use Illuminate\Support\Str;

/**
 * @covers \AvtoDev\CloudPayments\Requests\Traits\PaymentRequestTrait
 */
class PaymentRequestTraitTest extends AbstractUnitTestCase
{
    protected $request_builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->request_builder = new class {
            use PaymentRequestTrait;

            public function getCommonPaymentParamsData(): array
            {
                return $this->getCommonPaymentParams();
            }
        };
    }

    public function testRequiredGettersAndSetters(): void
    {
        $properties = [
            'Amount'    => (float) random_int(0, 100),
            'Currency'  => str_random(),
            'IpAddress' => str_random(),
        ];

        foreach ($properties as $key => $value) {
            $this->fieldTest($key, $value, false);
        }
    }

    public function testNullableGettersAndSetters(): void
    {
        $properties = [
            'InvoiceId'   => str_random(),
            'Description' => str_random(),
            'AccountId'   => str_random(),
            'Email'       => str_random(),
            //'JsonData'    => [str_random()], testJsonData
        ];

        foreach ($properties as $key => $value) {
            $this->fieldTest($key, $value, true);
        }
    }

    public function testJsonData(): void
    {
        $this->assertArrayNotHasKey('JsonData', $this->request_builder->getCommonPaymentParamsData());

        $this->request_builder->setJsonData(['some']);

        $this->assertSame(['some'], $this->request_builder->getJsonData());

        $common_payment_params = $this->request_builder->getCommonPaymentParamsData();

        $this->assertArrayHasKey('JsonData', $common_payment_params);

        $this->assertSame('["some"]', $common_payment_params['JsonData']);
    }

    protected function fieldTest(string $property_name, $value, bool $is_nullable): void
    {
        $method_postfix = Str::studly($property_name);

        $this->request_builder->{'set' . $method_postfix}($value);

        $this->assertSame($value, $this->request_builder->{'get' . $method_postfix}());

        $this->assertSame($value, $this->request_builder->getCommonPaymentParamsData()[$method_postfix]);

        if ($is_nullable) {
            $this->request_builder->{'set' . $method_postfix}(null);

            $this->assertNull($this->request_builder->{'get' . $method_postfix}());

            $this->assertArrayNotHasKey($method_postfix, $this->request_builder->getCommonPaymentParamsData());
        }
    }
}