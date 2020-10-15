<?php
/**
 * AmazonPay OrderReferenceDetail Request
 */

namespace Omnipay\Amazon\Messages;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class OrderReferenceRequest extends AbstractRequest
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
     * @return OrderReferenceResponse|ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data): OrderReferenceResponse
    {
        try {

            $response = $this->getClient()->getOrderReferenceDetails($data);
            var_dump($response);
            exit;
            return new OrderReferenceResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
