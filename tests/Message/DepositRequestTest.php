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

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('DepositSuccess.txt');
        $this->request->initialize($this->getValidParameters());

        /** @var DepositResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('aee933d28d0311e9b1c33a3031346235000006', $response->getTransactionCode());
        $this->assertNotNull($response->getCashierUrl());
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
