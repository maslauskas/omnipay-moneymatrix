<?php

namespace Omnipay\MoneyMatrix\Response;

class WithdrawalResponse extends Response
{
    /**
     * @return string|null
     */
    public function getTransactionCode(): ?string
    {
        return $this->data['TransactionCode'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCashierUrl(): ?string
    {
        return $this->data['CashierUrl'] ?? null;
    }

    /**
     * @return array
     */
    public function getSignatureParams(): array
    {
        return [
            'CashierUrl' => $this->getCashierUrl(),
            'ResponseCode' => $this->getResponseCode(),
        ];
    }
}
