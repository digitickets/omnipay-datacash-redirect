<?php

namespace Omnipay\DataCashRedirect\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompleteRedirectPurchaseResponse extends AbstractResponse
{
    /**
     *
     */
    const RESULT_SUCCESS = 1;

    /**
     * @param RequestInterface $request
     * @param \SimpleXMLElement $data
     */
    public function __construct(RequestInterface $request, \SimpleXMLElement $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * isRedirect
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return false;
    }

    /**
     * We expect 'RESULT' on the callback to be '00' to be successful
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->data->status)
            && static::RESULT_SUCCESS === (int)$this->data->status;
    }

    /**
     * getMessage
     */
    public function getMessage(): string
    {
        return isset($this->data->reason) ?
            $this->data->reason : null;
    }

    /**
     * getTransactionReference
     */
    public function getTransactionReference(): int
    {
        return isset($this->data->HpsTxn->datacash_reference) ?
            $this->data->HpsTxn->datacash_reference : null;
    }
}
