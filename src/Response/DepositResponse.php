<?php

namespace Omnipay\MoneyMatrix\Response;

use Omnipay\Common\Message\AbstractResponse;

class DepositResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }
}
