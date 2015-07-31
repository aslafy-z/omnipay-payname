<?php
/**
 * Payname Gateway
 */

namespace Omnipay\Payname;

use Omnipay\Common\AbstractGateway;

/**
 * Payname Gateway
 *
 * @see \Omnipay\Payname\Gateway
 * @link https://api.payname.fr/documentation/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Payname';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'secretKey' => '',
            'testMode' => false,
        );
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payname\Message\PopupPurchaseRequest', $parameters);
    }

    public function fetchToken(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payname\Message\FetchTokenRequest', $parameters);
    }
}
