<?php

namespace Reportei\Asaas\Services;

class Notification extends Api
{
    CONST ENDPOINT = 'notifications';

    public function __construct($accessToken, $sandbox)
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT);
    }

    public function updateBatch($data)
    {
        $url = parent::getUrl() . '/batch';
        $response = parent::post($url, $data);
        return $response;
    }
}