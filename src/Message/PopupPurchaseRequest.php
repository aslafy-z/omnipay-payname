<?php
/**
 * Payname Purchase Request (via popup)
 */

namespace Omnipay\Payname\Message;

/**
 * Payname Purchase Request (via popup)
 *
 * @see \Omnipay\Payname\Gateway
 * @link https://api.payname.fr/documentation/
 */
class PopupPurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');

        $data = array();
        $data['amount'] = $this->getAmountInteger();
        //$data['currency'] = strtolower($this->getCurrency());
        //$data['ip_address'] = $this->getClientIp();
        $data['order_id'] = $this->getOrderId();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('/popup', $data);

        return $this->response = new Response($this, $httpResponse->json());
    }
}
