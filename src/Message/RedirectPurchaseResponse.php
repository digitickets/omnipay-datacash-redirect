<?php

namespace Omnipay\DataCashRedirect\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use SimpleXMLElement;

/**
 * DataCash Response
 */
class RedirectPurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    const RESULT_SUCCESS = 1;

    /**
     * RedirectPurchaseResponse constructor.
     * @param RequestInterface $request
     * @param SimpleXMLElement $data
     * @throws InvalidResponseException
     */
    public function __construct(RequestInterface $request, SimpleXMLElement $data)
    {
        $this->request = $request;
        $this->data = $data;
        if (!isset($this->data->status)) {
            throw new InvalidResponseException;
        }
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->data->status)
            && static::RESULT_SUCCESS === (int)$this->data->status;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference(): string
    {
        return $this->data->datacash_reference;
    }

    /**
     * @return string
     */
    public function getTransactionId(): int
    {
        return $this->data->merchantreference;
    }

    /**
     * @return string|null
     */
    public function getMessage(): string
    {
        return $this->data->reason;
    }

    /**
     * @return SimpleXMLElement|string
     */
    public function getRedirectUrl(): string
    {
        return $this->data->HpsTxn->hps_url;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getRedirectData()
    {
        return array(
            'HPS_SessionID' => $this->data->HpsTxn->session_id,
        );
    }
}