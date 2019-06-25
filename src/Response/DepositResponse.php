<?php

namespace Omnipay\MoneyMatrix\Response;

class DepositResponse extends Response
{
    /**
     * @return string
     */
    public function getTransactionCode(): string
    {
        return $this->data['TransactionCode'];
    }

    /**
     * @return string
     */
    public function getCashierUrl(): string
    {
        return $this->data['CashierUrl'];
    }
}
