<?php
/**
 * AmazonPay Capture Request
 */

namespace Omnipay\Amazon\Messages;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class CaptureRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_authorization_id' => $this->getAuthorizationId(),
            'amount' => $this->getAmount(),
            'currency_code' => $this->getCurrencyCode(),
            'capture_reference_id' => $this->getCaptureId()
        ];
    }

    /**
     * @param mixed $data
     * @return CaptureResponse|ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data): CaptureResponse
    {
        try {
            $response = $this->getClient()->capture($data);

            return new CaptureResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}

