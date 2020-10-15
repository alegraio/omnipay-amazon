<?php

namespace Omnipay\Tests;

use Omnipay\Amazon\Messages\AuthorizeResponse;
use Omnipay\Amazon\Gateway;
use Omnipay\Amazon\Messages\CaptureResponse;
use Omnipay\Amazon\Messages\OrderReferenceResponse;
use Omnipay\Amazon\Messages\PurchaseResponse;
use Omnipay\Amazon\Messages\RefundResponse;


class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    public $gateway;

    /** @var array */
    public $options;

    public function setUp()
    {
        /** @var Gateway gateway */
        $this->gateway = new Gateway(null, $this->getHttpRequest());
        $this->gateway->setMerchantId('MERCHANT1234567');
        $this->gateway->setAccessKey('ABCDEFGHI1JKLMN2O7');
        $this->gateway->setSecretKey('abc123Def456gHi789jKLmpQ987rstu6vWxyz');
        $this->gateway->setClientId('amzn1.application-oa2-client.45789c45a8f34927830be1d9e029f480');
        $this->gateway->setRegion('us');
        $this->gateway->setTestMode(true);
    }

    public function testOrderReference()
    {
        $this->options = [
            'orderId' => '42424324'
        ];

        /** @var OrderReferenceResponse $response */
        $response = $this->gateway->getOrderReferenceDetail($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testAuthorize()
    {
        $this->options = [
            'orderId' => '42424324',
            'currencyCode' => 'usd',
            'amount' => '100',
            'authorizationId' => '232343',
            'capture' => true
        ];

        /** @var AuthorizeResponse $response */
        $response = $this->gateway->authorize($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCapture()
    {
        $this->options = [
            'orderId' => '42424324',
            'currencyCode' => 'usd',
            'amount' => '100',
            'authorizationId' => '232343',
            'captureId' => '1111124243'
        ];

        /** @var CaptureResponse $response */
        $response = $this->gateway->capture($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testPurchase()
    {
        $this->options = [
            'orderId' => '42424324',
            'currencyCode' => 'usd',
            'amount' => '100'
        ];

        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testRefund()
    {
        $this->options = [
            'captureId' => '42424324',
            'amount' => '100',
            'currencyCode' => 'us',
            'refundId' => '2312323'
        ];

        /** @var RefundResponse $response */
        $response = $this->gateway->refund($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }

    public function testCancel()
    {
        $this->options = [
            'orderId' => '42424324'
        ];

        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase($this->options)->send();
        $this->assertTrue($response->isSuccessful());
    }
}
