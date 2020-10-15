<?php
/**
 * AmazonPay Purchase Request
 */

namespace Omnipay\Amazon\Messages;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws Exception
     */
    public function getData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_order_reference_id' => $this->getOrderId(),
            'currency_code' => $this->getCurrencyCode(),
            'amount' => $this->getAmount()
        ];
    }

    /**
     * @return array
     */
    private function getConfirmOrderReferenceData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_order_reference_id' => $this->getOrderId()
        ];
    }

    /**
     * @param mixed $data
     * @return PurchaseResponse
     * @throws InvalidResponseException
     */
    public function sendData($data): PurchaseResponse
    {
        try {
            $orderReferenceDetails = $this->getClient()->setOrderReferenceDetails($data);
            $orderReferenceDetailResponse = new OrderReferenceResponse($this, $orderReferenceDetails->toArray());

            if (!$orderReferenceDetailResponse->isSuccessful()) {
                throw new Exception($orderReferenceDetailResponse->getMessage());
            }

            $response = $this->getClient()->confirmOrderReference($this->getConfirmOrderReferenceData());

            return new PurchaseResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
