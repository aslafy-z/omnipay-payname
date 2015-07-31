<?php
/**
 * Payname Abstract REST Request
 */

namespace Omnipay\Payname\Message;

/**
 * Payname Abstract REST Request
 *
 * This is the parent class for all Payname REST requests.
 *
 * The API has one endpoint hostname:
 *
 * * api.payname.fr
 *
 * @see \Omnipay\Payname\Gateway
 * @link https://api.payname.fr/documentation/
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const API_VERSION = '2';

    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $endpoint = 'https://api.payname.fr';

    /**
     * Get secret key
     *
     * Calls to the Pin Payments API must be authenticated using HTTP
     * basic authentication, with your API key as the username, and
     * a blank string as the password.
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->getTestMode() ? 'L0geHFzBQqN0RSWHrm7XhAnbt6gPZEtl' : $this->getParameter('secretKey');
    }

    /**
     * Set secret key
     *
     * Calls to the Pin Payments API must be authenticated using HTTP
     * basic authentication, with your API key as the username, and
     * a blank string as the password.
     *
     * @param string $value
     * @return AbstractRequest implements a fluent interface
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * Get API endpoint URL
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint . '/v' . self::API_VERSION;
    }

    /**
     * Send a request to the gateway.
     *
     * FIXME: This should be calling createRequest() instead of post()
     * to allow other HTTP methods to be used.
     *
     * @param string $action
     * @param array $data
     * @return HttpResponse
     */
    public function sendRequest($action, $data = null)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpResponse = $this->httpClient->post($this->getEndpoint() . $action, null, $data)
            ->setHeader('Authorization', $this->getSecretKey());

        return $httpResponse->send();
    }
}
