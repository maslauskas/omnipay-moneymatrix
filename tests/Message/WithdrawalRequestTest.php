<?php

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\MoneyMatrix\Message\WithdrawalRequest;
use Omnipay\MoneyMatrix\Response\DepositResponse;
use Omnipay\Tests\TestCase;

class WithdrawalRequestTest extends TestCase
{
    /**
     * @var WithdrawalRequest
     */
    private $request;
    /**
     * @var int
     */
    private $merchantId;
    /**
     * @var string
     */
    private $merchantKey;

    protected function setUp()
    {
        parent::setUp();
        $this->request = new WithdrawalRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->merchantId = 1234;
        $this->merchantKey = "SOME_RANDOM_STRING";
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
     * @expectedException InvalidRequestException
     * @expectedExceptionMessage The Amount parameter is required
     */
    public function testSendFailure_InvalidParameter_MissingRequired()
    {
        $this->request->initialize($this->getParametersWithMissing());
        $this->request->send();
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('WithdrawalSuccess.txt');
        $this->request->initialize($this->getValidParameters());

        /** @var DepositResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isValid(), 'Signature should be valid.');
        $this->assertFalse($response->isRedirect());
        $this->assertSame('bb170398a95511e990093a3031346235000006', $response->getTransactionCode());
        $this->assertNotNull($response->getCashierUrl());
    }

    public function testSendSuccess_InvalidSignature()
    {
        $this->merchantKey = uniqid();

        $this->setMockHttpResponse('WithdrawalSuccess.txt');

        $this->request->initialize($this->getValidParameters());

        /** @var DepositResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isValid(), 'Signature should be invalid.');
    }

    public function testSendFail_ChecksumInvalid()
    {
        $this->setMockHttpResponse('ChecksumInvalid.txt');
        $this->request->initialize($this->getValidParameters());

        /** @var DepositResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getTransactionCode());
        $this->assertNull($response->getCashierUrl());
    }

    private function getValidParameters()
    {
        return [
            "MerchantId" => $this->merchantId,
            "MerchantKey" => $this->merchantKey,
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
