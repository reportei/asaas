<?php

namespace Reportei\Asaas\Services;

class CreditCard extends Api
{
    CONST ENDPOINT = 'creditCard';

    public function __construct($accessToken, $sandbox, array $httpOptions = [])
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT, $httpOptions);
    }

    public function tokenize($data)
    {
        $url = parent::getUrl() . '/tokenizeCreditCard';
        $response = parent::post($url, $data);
        return $response;
    }
}