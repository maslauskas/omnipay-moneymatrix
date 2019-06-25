<?php

namespace Omnipay\MoneyMatrix\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Omnipay\Common\Message\AbstractResponse;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    /**
     * Get the merchant ID.
     *
     * @return int
     */
    public function getMerchantId()
    {
        return $this->getParameter('MerchantId');
    }

    /**
     * Set the merchant ID.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setMerchantId(int $value)
    {
        return $this->setParameter('MerchantId', $value);
    }

    /**
     * @return string
     */
    public function getMerchantKey()
    {
        return $this->getParameter('MerchantKey');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest
     */
    public function setMerchantKey(string $value)
    {
        return $this->setParameter('MerchantKey', $value);
    }

    /**
     * @return array
     */
    public abstract function getSignatureData(): array;


    /**
     * @param $data
     * @param array $headers
     *
     * @return AbstractResponse
     */
    abstract protected function createResponse($data, array $headers = []): AbstractResponse;

    /**
     * @param $data
     *
     * @return AbstractResponse
     */
    public function sendData($data): AbstractResponse
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $body = $data ? http_build_query($data, '', '&') : null;
        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        return $this->response = $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }

    /**
     * @return string
     */
    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @return string
     */
    protected abstract function getEndpoint(): string;

    /**
     * @return string
     */
    protected function getBaseEndpoint(): string
    {
        return ($this->getTestMode() === false)
            ? "https://api.moneymatrix.com/api/v1/Hosted"
            : "https://api-stage.moneymatrix.com/api/v1/Hosted";
    }
}
