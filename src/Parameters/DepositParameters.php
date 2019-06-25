<?php

namespace Omnipay\MoneyMatrix\Parameters;

use Symfony\Component\HttpFoundation\ParameterBag;

class DepositParameters extends ParameterBag
{
    /**
     * @return array
     */
    public function all()
    {
        $parameters = [
            // REQUIRED
            'MerchantId' => $this->get('MerchantId'),
            'CustomerId' => $this->get('CustomerId'),
            'CountryCode' => $this->get('CountryCode'),
            'MerchantReference' => $this->get('MerchantReference'),
            'IpAddress' => $this->get('IpAddress'),
            'AllowPaySolChange' => $this->get('AllowPaySolChange'),
            'PaymentMethod' => $this->get('PaymentMethod'),
            'Amount' =>  $this->getAmountString(),
            'Currency' => $this->get('Currency'),
            'EmailAddress' => $this->get('EmailAddress'),

            // OPTIONAL
            'CallbackUrl' => $this->get('CallbackUrl'),
            'SuccessUrl' => $this->get('SuccessUrl'),
            'FailUrl' => $this->get('FailUrl'),
            'CancelUrl' => $this->get('CancelUrl'),
            'CustomerGroups' => $this->get('CustomerGroups'),
            'Channel' => $this->get('Channel'),
            'FirstName' => $this->get('FirstName'),
            'LastName' => $this->get('LastName'),
            'BirthDate' => $this->get('BirthDate'),
            'RegistrationIpAddress' => $this->get('RegistrationIpAddress'),
            'RegistrationDate' => $this->get('RegistrationDate'),
            'Address' => $this->get('Address'),
            'City' => $this->get('City'),
            'State' => $this->get('State'),
            'PhoneNumber' => $this->get('PhoneNumber'),
            'PostalCode' => $this->get('PostalCode'),
            'Language' => $this->get('Language'),
        ];

        return array_filter($parameters);
    }

    /**
     * @return array
     */
    public function getSignatureData()
    {
        return [
            'MerchantReference' => $this->get('MerchantReference'),
            'PaymentMethod' => $this->get('PaymentMethod'),
            'CustomerId' => $this->get('CustomerId'),
            'Amount' => $this->getAmountString(),
            'Currency' => $this->get('Currency'),
        ];
    }

    /**
     * @return string
     */
    public function getAmountString()
    {
        return number_format($this->get('Amount'), 2);
    }

    /**
     * @return array
     */
    public function getRequiredParameters()
    {
        return [
            'Amount', 'Currency', 'CustomerId', 'CountryCode',
            'MerchantReference', 'IpAddress', 'AllowPaySolChange',
            /*'PaymentMethod',*/ 'EmailAddress'
        ];
    }
}
