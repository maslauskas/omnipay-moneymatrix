<?php

namespace Omnipay\MoneyMatrix\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\MoneyMatrix\Common\Signature;
use Omnipay\MoneyMatrix\Parameters\DepositParameters;
use Omnipay\MoneyMatrix\Parameters\WithdrawalParameters;
use Omnipay\MoneyMatrix\Response\WithdrawalResponse;

class WithdrawalRequest extends AbstractRequest
{
    /** @var DepositParameters */
    protected $parameters;

    /**
     * @param array $parameters
     *
     * @return $this|AbstractRequest
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->parameters = new WithdrawalParameters($parameters);

        return $this;
    }

    /**
     * @return array
     */
    public function getSignatureData(): array
    {
        return $this->parameters->getSignatureData();
    }

    /**
     * @param $data
     * @param array $headers
     *
     * @return AbstractResponse
     */
    protected function createResponse($data, array $headers = []): AbstractResponse
    {
        return new WithdrawalResponse($this, $data, $headers);
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getBaseEndpoint() . '/InitWithdraw';
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(...$this->parameters->getRequiredParameters());

        $signature = new Signature($this->getMerchantId(), $this->getMerchantKey());

        $data = $this->parameters->all();
        $data['Signature'] = $signature->generate($this->getSignatureData());

        return $data;
    }
}
