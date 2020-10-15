<?php
/**
 * AmazonPay Abstract Request
 */

namespace Omnipay\Amazon\Messages;

use AmazonPay\Client;
use Exception;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    /** @var Client */
    protected $client;

    /**
     * @return Client
     * @throws Exception
     */
    protected function getClient(): Client
    {
        $config = [
            'merchant_id' => $this->getMerchantId(),
            'access_key' => $this->getAccessKey(),
            'secret_key' => $this->getSecretKey(),
            'client_id' => $this->getClientId(),
            'region' => $this->getRegion(),
            'sandbox' => $this->getTestMode()
        ];
        try {
            /** @var Client $client */
            $client = new Client($config);
        } catch (Exception $e) {
            throw new Exception("Client connection error.");
        }

        return $client;
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
     * @return AbstractRequest
     */
    public function setMerchantId(string $value): AbstractRequest
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
     * @return AbstractRequest
     */
    public function setAccessKey(string $value): AbstractRequest
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
     * @return AbstractRequest
     */
    public function setSecretKey(string $value): AbstractRequest
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
     * @return AbstractRequest
     */
    public function setClientId(string $value): AbstractRequest
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
     * @return AbstractRequest
     */
    public function setRegion(string $value): AbstractRequest
    {
        return $this->setParameter('region', $value);
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setOrderId(string $value): AbstractRequest
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->getParameter('orderId');
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return (string)$this->getParameter('currencyCode');
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setCurrencyCode(string $value): AbstractRequest
    {
        return $this->setParameter('currencyCode', $value);
    }

    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setAuthorizationId(string $value): AbstractRequest
    {
        return $this->setParameter('authorizationId', $value);
    }

    /**
     * @return string
     */
    public function getAuthorizationId(): string
    {
        return $this->getParameter('authorizationId');
    }


    /**
     * @param string $value
     * @return AbstractRequest
     */
    public function setCaptureId(string $value): AbstractRequest
    {
        return $this->setParameter('captureId', $value);
    }

    /**
     * @return string
     */
    public function getCaptureId(): string
    {
        return $this->getParameter('captureId');
    }

}
