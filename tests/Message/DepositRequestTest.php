<?php

use Omnipay\MoneyMatrix\Message\DepositRequest;
use Omnipay\MoneyMatrix\Response\DepositResponse;
use Omnipay\Tests\TestCase;

class DepositRequestTest extends TestCase
{
    /**
     * @var DepositRequest
     */
    private $request;

    protected function setUp()
    {
        parent::setUp();
        $this->request = new DepositRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testAddSignatureToData()
    {
        $this->request->initialize($this->getValidParameters());
        $this->assertArrayHasKey('Signature', $this->request->getData());
    }

    private function getValidParameters()
    {
        return [
            "MerchantId" => 1234,
            "MerchantKey" => uniqid(),

            "CustomerId" => 123,
            "CountryCode" => "GB",
            "MerchantReference" => uniqid(),
            "IpAddress" => "127.0.0.1",
            "AllowPaySolChange" => true,
            "PaymentMethod" => null,
            "Amount" => 10.00,
            "Currency" => "EUR",
            "EmailAddress" => "john.doe@example.com",
        ];
    }
}
