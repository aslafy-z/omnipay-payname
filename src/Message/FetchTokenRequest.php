<?php
/**
 * Payname Fetch Token Request
 */

namespace Omnipay\Payname\Message;

/**
 * Payname Fetch Token Request
 *
 * @see \Omnipay\Payname\Gateway
 * @link https://api.payname.fr/documentation/
 */
class FetchTokenRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['ID'] = $this->getParameter('apiKey');
        $data['secret'] = $this->getParameter('secretKey');

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('/auth/token', $data);

        return $this->response = new Response($this, $httpResponse->json());
    }
}
