<?php
/**
 * AmazonPay Void Request
 */

namespace Omnipay\Amazon\Messages;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class VoidRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws Exception
     */
    public function getData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_order_reference_id' => $this->getOrderId()
        ];
    }


    /**
     * @param mixed $data
     * @return VoidResponse|ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data): VoidResponse
    {
        try {
            $response = $this->getClient()->cancelOrderReference($data);

            return new VoidResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
