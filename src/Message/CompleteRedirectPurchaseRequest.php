<?php

namespace Omnipay\DataCashRedirect\Message;

use SimpleXMLElement;

class CompleteRedirectPurchaseRequest extends AbstractPurchaseRequest
{
    /**
     * @return SimpleXMLElement
     */
    public function getData(): SimpleXMLElement
    {
        $dataArray = $this->httpRequest->query->all();
        $data = new SimpleXMLElement('<Request/>');

        $data->Authentication->client = $this->getMerchantId();
        $data->Authentication->password = $this->getPassword();
        $data->Transaction->HistoricTxn->method = 'query';
        $data->Transaction->HistoricTxn->reference = $dataArray['dts_reference'];

        return $data;
    }

    /**
     * We don't need to send anything back to the provider so we just return
     * a CompleteRedirectPurchaseResponse with the data coming from the
     * provider's request (callback)
     *
     * @param mixed $data
     *
     * @return CompleteRedirectPurchaseResponse
     */
    public function sendData($data): CompleteRedirectPurchaseResponse
    {
        $xml = $data->saveXML();
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $xml)->send();

        return $this->response = new CompleteRedirectPurchaseResponse($this, $httpResponse->xml());
    }
}
