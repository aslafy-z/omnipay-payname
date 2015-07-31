<?php

namespace Omnipay\Payname\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * WorldPay XML Redirect Response
 */
class RedirectResponse extends Response implements RedirectResponseInterface
{
    public function isRedirect()
    {
        return isset($this->data['data']['url']);
    }

    /**
     * Get redirect data
     *
     * @access public
     * @return array
     */
    public function getRedirectData()
    {
        return array(
            'url'   => $this->data['data']['url']
        );
    }

    /**
     * Get redirect method
     *
     * @access public
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Get redirect url
     *
     * @access public
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->data['data']['url'];
    }
}
