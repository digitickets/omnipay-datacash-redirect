<?php

namespace Omnipay\DataCashRedirect\Message;

use SimpleXMLElement;

/**
 * DataCash Purchase Request
 */
class RedirectPurchaseRequest extends AbstractPurchaseRequest
{

    /**
     * @return mixed|SimpleXMLElement
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): SimpleXMLElement
    {
        $this->validate('amount');

        $data = new SimpleXMLElement('<Request/>');

        $data->Authentication->client = $this->getMerchantId();
        $data->Authentication->password = $this->getPassword();
        $data->Transaction->TxnDetails->amount = $this->getAmount();
        $data->Transaction->TxnDetails->amount->addAttribute('currency', $this->getCurrency());
        $data->Transaction->TxnDetails->merchantreference = str_pad($this->getTransactionId(), 6, 0, STR_PAD_LEFT);
        $data->Transaction->CardTxn->method = 'auth';
        $data->Transaction->HpsTxn->method = 'setup_full';
        $data->Transaction->HpsTxn->page_set_id = $this->getPageId();
        $data->Transaction->HpsTxn->return_url = $this->getReturnUrl();
        $data->Transaction->HpsTxn->error_url = $this->getReturnUrl();

        return $data;
    }

    /**
     * @param SimpleXMLElement $data
     * @return RedirectPurchaseResponse
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): RedirectPurchaseResponse
    {
        $xml = $data->saveXML();
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $xml)->send();

        return $this->response = new RedirectPurchaseResponse($this, $httpResponse->xml());
    }
}