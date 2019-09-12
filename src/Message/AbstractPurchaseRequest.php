<?php

namespace Omnipay\DataCash\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\DataCash\Traits\GatewayParamsTrait;

abstract class AbstractPurchaseRequest extends AbstractRequest
{
    use GatewayParamsTrait;

    /**
     * @var string
     */
    protected $liveEndpoint = 'https://mars.transaction.datacash.com/Transaction';
    /**
     * @var string
     */
    protected $testEndpoint = 'https://testserver.datacash.com/Transaction';

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
