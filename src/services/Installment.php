<?php

namespace Reportei\Asaas\Services;

class Installment extends Api
{
    CONST ENDPOINT = 'installments';

    public function __construct($accessToken, $sandbox)
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT);
    }

    public function refund($id)
    {
        $url = parent::getUrl() . '/' . $id . '/refund';
        $response = parent::post($url);
        return $response;
    }
    
    public function delete($id)
    {
        $url = parent::getUrl() . '/' . $id;
        $response = parent::delete($url);
        return $response;
    }
}