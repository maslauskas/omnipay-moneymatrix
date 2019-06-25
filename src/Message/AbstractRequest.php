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
     * @param int $merchantId
     * @return $this
     */
    public function setMerchantId(int $merchantId)
    {
        return $this->setParameter('MerchantId', $merchantId);
    }
}
