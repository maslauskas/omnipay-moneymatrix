<?php

use Omnipay\MoneyMatrix\Common\Signature;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    /**
     * @var Signature
     */
    private $generator;

    protected function setUp(): void
    {
        parent::setUp();
        $merchantId = "1008";
        $merchantKey = "066B1741D3D111E59E9846218491E2A3";

        $this->generator = new Signature($merchantId, $merchantKey);
    }

    public function testGenerateSignature()
    {
        $data = [
            'MerchantReference' => '3c05bea5191d4ff085216b100ca2183f',
            'PaymentMethod' => 'CreditCard',
            'CustomerId' => '1008~121223',
            'Amount' => '102.00',
            'Currency' => 'USD',
        ];

        $expected = "IOWi0IyH74nU7O0Da8WngNMXUviUcsi72AL19epTObl7dy6RX41e2KHBJC0LzmDAO8BENlJd1KYTQrwCS2ofpA==";
        $signature = $this->generator->generate($data);

        self::assertTrue(hash_equals($expected, $signature), "Hashes are not equal!");
    }

    public function testIsValid()
    {
        $data = [
            'MerchantReference' => '3c05bea5191d4ff085216b100ca2183f',
            'PaymentMethod' => 'CreditCard',
            'CustomerId' => '1008~121223',
            'Amount' => '102.00',
            'Currency' => 'USD',
        ];

        $signature = "IOWi0IyH74nU7O0Da8WngNMXUviUcsi72AL19epTObl7dy6RX41e2KHBJC0LzmDAO8BENlJd1KYTQrwCS2ofpA==";

        self::assertTrue($this->generator->isValid($signature, $data));
    }
}