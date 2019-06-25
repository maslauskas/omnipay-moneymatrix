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

    public function testGetData()
    {
        $this->request->initialize($this->getValidParameters());

        $data = $this->request->getData();

        $this->assertSame("10.00", $data['Amount']);
        $this->assertSame('EUR', $data['Currency']);
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage The Amount parameter is required
     */
    public function testSendFailure_InvalidParameter_MissingRequired()
    {
        $this->request->initialize($this->getParametersWithMissing());
        $this->request->send();
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

    /**
     * @return array
     */
    protected function getParametersWithMissing()
    {
        return [
            "MerchantId" => 1234,
            "MerchantKey" => uniqid(),
        ];
    }
}
