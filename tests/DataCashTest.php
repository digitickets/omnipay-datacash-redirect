<?php

namespace Omnipay\DataCash\Test\Gateway;

use Omnipay\DataCash\Gateway;
use Omnipay\Tests\GatewayTestCase;

class DataCashTest extends GatewayTestCase
{
    /**
     * @var \Omnipay\DataCash\Gateway
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $cardData = null;

    /**
     * Setup
     */
    protected function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
    }
}
