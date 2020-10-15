<?php
/**
 * AmazonPay Abstract Response
 */

namespace Omnipay\Amazon\Messages;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * @return boolean
     */
    public function isSuccessful(): bool
    {
        return !isset($this->data["Error"]) ? true : false;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return !$this->isSuccessful() ? $this->data['Error']['Message'] : null;
    }
}
