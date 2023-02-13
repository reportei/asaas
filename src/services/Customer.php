<?php

namespace Reportei\Asaas\Services;

class Customer extends Api
{
    CONST ENDPOINT = 'customers';

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

    public function getByEmail($email)
    {
        $filters = ['email' => $email];
        $response = $this->getAll($filters);
        return $response[0] ?? null;
    }

    public function getByCpfCnpj($cpfCnpj)
    {
        $filters = ['cpfCnpj' => $cpfCnpj];
        $response = $this->getAll($filters);
        return $response[0] ?? null;
    }

    public function getAll($filters = [])
    {
        $url = parent::getUrl();
        $response = parent::getWithPagination($url, $filters);
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

    public function restore($id)
    {
        $url = parent::getUrl() . '/' . $id . '/restore';
        $response = parent::post($url);
        return $response;
    }
}