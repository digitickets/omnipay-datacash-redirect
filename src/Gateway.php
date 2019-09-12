<?php

namespace Omnipay\DataCash;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\DataCash\Traits\GatewayParamsTrait;

/**
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    use GatewayParamsTrait;
    /**
     * Get gateway name
     *
     * @return string
     */
    public function getName() : string
    {
        return 'DataCash';
    }

    /**
     * Get gateway default parameters
     *
     * @return array
     */
    public function getDefaultParameters() : array
    {
        return array(
            'merchantId' => '',
            'password' => '',
            'pageId'=>'',
            'testMode' => true
        );
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest('\Omnipay\DataCash\Message\RedirectPurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest|RequestInterface
     */
    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest('\Omnipay\DataCash\Message\CompleteRedirectPurchaseRequest', $parameters);
    }
}
