<?php

namespace Omnipay\MoneyMatrix\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;

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
}
