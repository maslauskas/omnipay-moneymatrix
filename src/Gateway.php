<?php

namespace Omnipay\MoneyMatrix;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoneyMatrix\Message\AcceptNotificationRequest;
use Omnipay\MoneyMatrix\Message\DepositRequest;

class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return "MoneyMatrix";
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => true,
        ];
    }

    /**
     * @return int
     */
    public function getMerchantId()
    {
        return $this->getParameter('MerchantId');
    }

    /**
     * @param int $merchantId
     *
     * @return Gateway
     */
    public function setMerchantId(int $merchantId)
    {
        return $this->setParameter('MerchantId', $merchantId);
    }

    /**
     * {@inheritdoc}
     */
    public function initDeposit(array $options = [])
    {
        return $this->createRequest(DepositRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(AcceptNotificationRequest::class, $options);
    }
}
