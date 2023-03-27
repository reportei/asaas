<?php

namespace Reportei\Asaas\Services;

class Subscription extends Api
{
    CONST ENDPOINT = 'subscriptions';

    public function __construct($accessToken, $sandbox)
    {
        parent::__construct($accessToken, $sandbox, self::ENDPOINT);
    }

    public function getById($id)
    {
        $url = parent::getUrl() . '/' . $id;
        $response = parent::get($url);
        return $response->object === "subscription" ? $response : null;
    }

    public function getByCustomer($customer_id)
    {
        $filters = ['customer' => $customer_id];
        $response = $this->getAll($filters);
        return $response[0] ?? null;
    }

    public function getAll($filters = [])
    {
        $url = parent::getUrl();
        $response = parent::getWithPagination($url, $filters);
        return $response;
    }

    public function getAllPaymentsById($id)
    {
        $url = parent::getUrl() . '/' . $id . '/payments';
        $response = parent::getWithPagination($url);
        return $response;
    }

    public function create($data)
    {
        $url = parent::getUrl();
        $response = parent::post($url, $data);
        return $response;
    }

    public function update($id, $data)
    {
        $url = parent::getUrl() . '/' . $id;
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