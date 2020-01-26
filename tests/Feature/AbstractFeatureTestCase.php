<?php

namespace AvtoDev\Tests\Feature;

use AvtoDev\CloudPayments\Client;
use AvtoDev\CloudPayments\Config;
use AvtoDev\Tests\AbstractTestCase;

class AbstractFeatureTestCase extends AbstractTestCase
{
    /**
     * @var Client
     */
    protected $cloud_payments_client;

    public function setUp(): void
    {
        parent::setUp();

        $config = require __DIR__ . '/config.php';

        $this->cloud_payments_client = Client::factory(new Config($config['cloud_payments']));
    }
}
