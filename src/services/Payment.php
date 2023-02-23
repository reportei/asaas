<?php

namespace Reportei\Asaas\Services;

class Payment extends Api
{
    CONST ENDPOINT = 'payments';

    public function __construct($accessToken, $sandbox)
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT);
    }

    public function getById($id)
    {
        $url = parent::getUrl() . '/' . $id;
        $response = parent::get($url);
        return $response;
    }

    public function getBarcode($id)
    {
        $url = parent::getUrl() . '/' . $id . '/identificationField';
        $response = parent::get($url);
        return $response;
    }

    public function getQRCode($id)
    {
        $url = parent::getUrl() . '/' . $id . '/pixQrCode';
        $response = parent::get($url);
        return $response;
    }
}