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
            'secretKey' => '',
            'testMode' => false,
        );
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
}
