<?php

namespace Omnipay\MoneyMatrix\Message;

use Omnipay\Common\Message\AbstractResponse;

class AcceptNotificationRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    /**
     * @return array
     */
    public function getSignatureData(): array
    {
        // TODO: Implement getSignatureData() method.
    }

    /**
     * @param $data
     * @param array $headers
     *
     * @return AbstractResponse
     */
    protected function createResponse($data, array $headers = []): AbstractResponse
    {
        // TODO: Implement createResponse() method.
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        // TODO: Implement getEndpoint() method.
    }
}
