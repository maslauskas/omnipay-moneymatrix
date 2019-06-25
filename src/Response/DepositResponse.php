<?php

namespace Omnipay\MoneyMatrix\Response;

class DepositResponse extends Response
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
}
