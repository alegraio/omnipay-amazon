<?php
/**
 * AmazonPay Class using API
 */

namespace Omnipay\Amazon;

use Omnipay\Amazon\Messages\InfoRequest;
use Omnipay\Amazon\Messages\OrderReferenceRequest;
use Omnipay\Amazon\Messages\PurchaseRequest;
use Omnipay\Amazon\Messages\RefundRequest;
use Omnipay\Amazon\Messages\VoidRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Amazon\Messages\AuthorizeRequest;
use Omnipay\Amazon\Messages\CaptureRequest;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName(): string
    {
        return 'AmazonPay';
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setMerchantId(string $value): Gateway
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->getParameter('accessKey');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setAccessKey(string $value): Gateway
    {
        return $this->setParameter('accessKey', $value);
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setSecretKey(string $value): Gateway
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->getParameter('clientId');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setClientId(string $value): Gateway
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->getParameter('region');
    }

    /**
     * @param string $value
     * @return Gateway
     */
    public function setRegion(string $value): Gateway
    {
        return $this->setParameter('region', $value);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function authorize(array $parameters = []): RequestInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function capture(array $parameters = []): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function refund(array $parameters = []): RequestInterface
    {
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function void(array $parameters = []): RequestInterface
    {
        return $this->createRequest(VoidRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return AbstractRequest|RequestInterface
     */
    public function getOrderReferenceDetail(array $parameters = []): RequestInterface
    {
        return $this->createRequest(OrderReferenceRequest::class, $parameters);
    }
}
