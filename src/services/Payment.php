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

    public function getByCustomer($customer_id)
    {
        $filters = ['customer' => $customer_id];
        $response = $this->getAll($filters);
        return $response ?? null;
    }

    public function getAll($filters = [])
    {
        $url = parent::getUrl();
        $response = parent::getWithPagination($url, $filters);
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

    public function create($data)
    {
        $url = parent::getUrl();
        $response = parent::post($url, $data);
        return $response;
    }

    public function refund($id, $data)
    {
        $url = parent::getUrl() . '/' . $id . '/refund';
        $response = parent::post($url, $data);
        return $response;
    }
    
    public function delete($id)
    {
        $url = parent::getUrl() . '/' . $id;
        $response = parent::delete($url);
        return $response;
    }
}