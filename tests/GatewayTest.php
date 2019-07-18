<?php

use Omnipay\MoneyMatrix\Gateway as MoneyMatrixGateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var MoneyMatrixGateway */
    protected $gateway;

    /** @var int */
    protected $merchantId;

    /** @var bool */
    protected $testMode;

    protected function setUp()
    {
        parent::setUp();

        $this->gateway = new MoneyMatrixGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->merchantId = 1234;
    }

    public function testDefaultParameters()
    {
        $this->assertSame(true, $this->gateway->getTestMode());
    }

    public function testInitDeposit()
    {
        $request = $this->gateway->initDeposit([
            'amount' => 10.5
        ]);

        $this->assertInstanceOf('\Omnipay\MoneyMatrix\Message\DepositRequest', $request);
        $this->assertSame(1050, $request->getAmountInteger());
    }

    public function testInitWithdrawal()
    {
        $request = $this->gateway->initWithdrawal([
            'amount' => 15.5
        ]);

        $this->assertInstanceOf('\Omnipay\MoneyMatrix\Message\WithdrawalRequest', $request);
        $this->assertSame(1550, $request->getAmountInteger());
    }

    public function testAcceptNotification()
    {
        $this->assertTrue($this->gateway->supportsAcceptNotification());

        $request = $this->gateway->acceptNotification();
        $this->assertInstanceOf('\Omnipay\MoneyMatrix\Message\AcceptNotificationRequest', $request);
    }
}
