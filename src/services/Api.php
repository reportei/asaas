<?php

namespace Reportei\Asaas\Services;

use GuzzleHttp\Client;

class Api
{
    const BASE_URL_PRODUCTION = "https://www.asaas.com/api";
    const BASE_URL_SANDBOX = "https://sandbox.asaas.com/api";
    const VERSION = "v3";
    const PAGE_SIZE = 100;

    protected $accessToken;
    protected $sandbox;
    protected $endPoint;
    protected $client;

    public function __construct($accessToken, $sandbox = true, $endPoint = "")
    {
        $this->accessToken = $accessToken;
        $this->sandbox = $sandbox;
        $this->endPoint = $endPoint;
        $this->client = new Client();
    }

    public function getUrl()
    {
        $baseUrl = $this->sandbox ? self::BASE_URL_SANDBOX : self::BASE_URL_PRODUCTION;
        return $baseUrl . '/' . self::VERSION . '/' . $this->endPoint;
    }

    public function getHeaders()
    {
        return [
            'access_token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ];
    }

    public function get($url) {
        $headers = $this->getHeaders();

        $response = $this->client->get($url, [
            'headers' => $headers,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getWithPagination($url, $data = []) {
        $data["offset"] = 0;
        $data["limit"] = self::PAGE_SIZE;
        $headers = $this->getHeaders();

        $allResponses = array();
        do {
            $urlWithData = $url . '?' . http_build_query($data);
            $response = $this->client->get($urlWithData, [
                'headers' => $headers,
            ]);
            $response = json_decode($response->getBody()->getContents());
            $allResponses = array_merge($allResponses, $response->data);
            $data["offset"] = count($allResponses);
        } while ($response->hasMore);
        
        return $allResponses;
    }

    public function post($url, $data = null)
    {
        $headers = $this->getHeaders();

        $response = $this->client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function delete($url) {
        $headers = $this->getHeaders();

        $response = $this->client->delete($url, [
            'headers' => $headers,
        ]);

        return json_decode($response->getBody()->getContents());
    }
}