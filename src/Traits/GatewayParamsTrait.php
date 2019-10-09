<?php

namespace Omnipay\DataCashRedirect\Traits;

/**
 * Parameters that can be set at the gateway class, and so
 * must also be available at the request message class.
 */
trait GatewayParamsTrait
{
    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getPageId()
    {
        return $this->getParameter('pageId');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPageId($value)
    {
        return $this->setParameter('pageId', $value);
    }
}
