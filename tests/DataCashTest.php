<?php

namespace Omnipay\DataCashRedirect\Test\Gateway;

use Omnipay\DataCashRedirect\Gateway;
use Omnipay\Tests\GatewayTestCase;

class DataCashTest extends GatewayTestCase
{
    /**
     * @var \Omnipay\DataCashRedirect\Gateway
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
