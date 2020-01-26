<?php

namespace AvtoDev\Tests\Feature;

use AvtoDev\CloudPayments\Requests\TestRequestBuilder;

/**
 * @coversNothing
 */
class FeatureTestsTest extends AbstractFeatureTestCase
{
    public function testTest()
    {

        $response = $this->cloud_payments_client->send((new TestRequestBuilder)->buildRequest());

        dump((string) $response->getBody());

        $this->assertTrue(true);
    }
}
