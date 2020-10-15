<?php
/**
 * AmazonPay Refund Request
 */

namespace Omnipay\Amazon\Messages;

use Exception;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\ResponseInterface;

class RefundRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws Exception
     */
    public function getData(): array
    {
        return [
            'merchant_id' => $this->getMerchantId(),
            'amazon_capture_id' => $this->getCaptureId(),
            'amount' => $this->getAmount(),
            'currency_code' => $this->getCurrencyCode(),
            'refund_reference_id' => $this->getRefundId()
        ];
    }

    /**
     * @param string $value
     * @return RefundRequest
     */
    public function setRefundId(string $value): RefundRequest
    {
        return $this->setParameter('refundId', $value);
    }

    /**
     * @return string
     */
    public function getRefundId(): string
    {
        return $this->getParameter('refundId');
    }

    /**
     * @param mixed $data
     * @return RefundResponse|ResponseInterface
     * @throws InvalidResponseException
     */
    public function sendData($data): RefundResponse
    {
        try {
            $response = $this->getClient()->refund($data);

            return new RefundResponse($this, $response->toArray());
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
