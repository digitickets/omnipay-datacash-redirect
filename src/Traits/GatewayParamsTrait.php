<?php

namespace Omnipay\DataCash\Traits;

/**
 * Parameters that can be set at the gateway class, and so
 * must also be available at the request message class.
 */
trait GatewayParamsTrait
{
    /**
     * @return mixed
     */
    public function getMerchantId(): int
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMerchantId(int $value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPassword(string $value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getPageId(): int
    {
        return $this->getParameter('pageId');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPageId(int $value)
    {
        return $this->setParameter('pageId', $value);
    }
}
