<?php

namespace Omnipay\MoneyMatrix\Response;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\MoneyMatrix\Common\Signature;
use Omnipay\MoneyMatrix\Message\AbstractRequest;

abstract class Response extends AbstractResponse
{
    /**
     * @var AbstractRequest
     */
    protected $request;
    /**
     * @var array
     */
    protected $headers;

    /**
     * Response constructor.
     *
     * @param AbstractRequest $request
     * @param $data
     * @param array $headers
     */
    public function __construct(AbstractRequest $request, $data, array $headers = [])
    {
        parent::__construct($request, json_decode($data, true));
        $this->headers = $headers;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->getResponseCode() >= 1 && $this->getResponseCode() <= 10;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $signature = new Signature($this->request->getMerchantId(), $this->request->getMerchantKey());

        return $signature->isValid($this->getSignature(), $this->getSignatureParams());
    }

    public abstract function getSignatureParams(): array;

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->data['ResponseCode'];
    }


    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->data['RequestId'];
    }


    /**
     * @return string
     */
    public function getResponseMessage(): string
    {
        return $this->data['ResponseMessage'];
    }

    /**
     * @return string
     */
    public function getResponseDisplayText(): string
    {
        return $this->data['ResponseDisplayText'];
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->data['Signature'];
    }
}
