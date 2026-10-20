<?php

namespace Reportei\Asaas\Services;

class Notification extends Api
{
    CONST ENDPOINT = 'notifications';

    public function __construct($accessToken, $sandbox, array $httpOptions = [])
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT, $httpOptions);
    }

    public function updateBatch($data)
    {
        $url = parent::getUrl() . '/batch';
        $response = parent::post($url, $data);
        return $response;
    }
}