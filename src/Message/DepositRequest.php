<?php

namespace Omnipay\MoneyMatrix\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\MoneyMatrix\Common\Signature;

class DepositRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $signature = new Signature($this->getMerchantId(), $this->getMerchantKey());

        $data = [
            'MerchantId' => $this->getMerchantId(),
            'Signature' => $signature->generate($this->getSignatureData())
        ];

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }

    /**
     * @return array
     */
    public function getSignatureData(): array
    {
        return [
            'MerchantReference' => $this->getMerchantReference(),
            'PaymentMethod' => $this->getPaymentMethod(),
            'CustomerId' => $this->getCustomerId(),
            'Amount' => $this->getAmountString(),
            'Currency' => $this->getCurrency(),
        ];
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->getParameter('MerchantReference');
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->getParameter('PaymentMethod');
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getParameter('CustomerId');
    }

    /**
     * @return string
     */
    public function getAmountString()
    {
        return number_format($this->getParameter('Amount'), 2);
    }
}
