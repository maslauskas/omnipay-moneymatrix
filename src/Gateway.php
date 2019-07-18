<?php

namespace Omnipay\MoneyMatrix;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoneyMatrix\Message\AcceptNotificationRequest;
use Omnipay\MoneyMatrix\Message\DepositRequest;
use Omnipay\MoneyMatrix\Message\WithdrawalRequest;

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
     * @return string
     */
    public function getMerchantKey()
    {
        return $this->getParameter('MerchantKey');
    }

    /**
     * @param string $value
     *
     * @return Gateway
     */
    public function setMerchantKey(string $value)
    {
        return $this->setParameter('MerchantKey', $value);
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
    public function initWithdrawal(array $options = [])
    {
        return $this->createRequest(WithdrawalRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(AcceptNotificationRequest::class, $options);
    }
}
