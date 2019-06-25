<?php

namespace Omnipay\MoneyMatrix\Response;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class Response extends AbstractResponse
{
    /**
     * @var array
     */
    protected $headers;

    /**
     * Response constructor.
     *
     * @param RequestInterface $request
     * @param $data
     * @param array $headers
     */
    public function __construct(RequestInterface $request, $data, array $headers = [])
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
        return true;
    }

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
