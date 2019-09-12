<?php

namespace Omnipay\DataCash\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\RequestInterface;
use SimpleXMLElement;

/**
 * DataCash Response
 */
class RedirectPurchaseResponse extends AbstractPurchaseResponse
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
     * Returns true if the response from the gateway is successful 
     * 
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data->status)
            && static::RESULT_SUCCESS === (int)$this->data->status;
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
    public function getTransactionId(): string
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