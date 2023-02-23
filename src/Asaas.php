<?php

namespace Reportei\Asaas;

use Reportei\Asaas\Services\Customer;
use Reportei\Asaas\Services\Subscription;
use Reportei\Asaas\Services\Payment;

class Asaas
{
    protected $accessToken;
    protected $sandbox;

    public function __construct($accessToken, $sandbox = true)
    {
        $this->accessToken = $accessToken;
        $this->sandbox = $sandbox;
    }

    public function customer()
    {
        return new Customer($this->accessToken, $this->sandbox);
    }

    public function subscription()
    {
        return new Subscription($this->accessToken, $this->sandbox);
    }

    public function payment()
    {
        return new Payment($this->accessToken, $this->sandbox);
    }
}