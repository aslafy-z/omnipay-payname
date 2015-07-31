<?php
/**
 * Payname Response
 */

namespace Omnipay\Payname\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Payname Response
 *
 * This is the response class for all Payname REST requests.
 *
 * @see \Omnipay\Payname\Gateway
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data['success'] === true;
    }

    public function getMessage()
    {
        if ($this->isSuccessful()) {
            return $this->data['msg'];
        } else {
            return $this->data['error'] . ' - ' . $this->data['msg'];
        }
    }
}
