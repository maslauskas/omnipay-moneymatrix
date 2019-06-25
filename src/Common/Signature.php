<?php

namespace Omnipay\MoneyMatrix\Common;

class Signature
{
    /**
     * @var string
     */
    private $merchantId;

    /**
     * @var string
     */
    private $merchantKey;

    /**
     * Signature constructor.
     *
     * @param string $merchantId
     * @param string $merchantKey
     */
    public function __construct(string $merchantId, string $merchantKey)
    {
        $this->merchantId = $merchantId;
        $this->merchantKey = $merchantKey;
    }

    /**
     * @param string $signature
     * @param array $data
     *
     * @return bool
     */
    public function isValid(string $signature, array $data): bool
    {
        return hash_equals($this->generate($data), $signature);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function generate(array $parameters): string
    {
        $data = $this->concat($parameters);

        $hash = hash_hmac('sha512', $data, $this->merchantKey, true);

        return base64_encode($hash);
    }

    /**
     * @param $parameters
     *
     * @return string
     */
    private function concat($parameters): string
    {
        $data = '' . $this->merchantId;

        foreach ($parameters as $parameter => $value) {
            $data .= sprintf('%s=\'%s\';', $parameter, $value);
        }

        $data .= $this->merchantKey;

        return $data;
    }
}
