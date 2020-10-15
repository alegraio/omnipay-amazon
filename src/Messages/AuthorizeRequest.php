<?php
/**
 * AmazonPay Authorize Request
 */

namespace Omnipay\Amazon\Messages;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class AuthorizeRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_order_reference_id' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'currency_code' => $this->getCurrencyCode(),
            'authorization_reference_id' => $this->getAuthorizationId(),
            'capture_now' => $this->getCapture()
        ];
    }

    /**
     * @param bool $value
     * @return AbstractRequest
     */
    public function setCapture(bool $value): AbstractRequest
    {
        return $this->setParameter('capture', $value);
    }

    /**
     * @return bool
     */
    public function getCapture(): bool
    {
        return $this->getParameter('capture');
    }

    /**
     * @param mixed $data
     * @return AuthorizeResponse|ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data): AuthorizeResponse
    {
        try {
            $response = $this->getClient()->authorize($data);

            return new AuthorizeResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}

