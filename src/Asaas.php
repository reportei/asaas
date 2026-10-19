<?php

namespace Reportei\Asaas;

use Reportei\Asaas\Services\CreditCard;
use Reportei\Asaas\Services\Customer;
use Reportei\Asaas\Services\Installment;
use Reportei\Asaas\Services\Notification;
use Reportei\Asaas\Services\Subscription;
use Reportei\Asaas\Services\Payment;

class Asaas
{
    protected $accessToken;
    protected $sandbox;
    protected $httpOptions;

    public function __construct($accessToken, $sandbox = true, array $httpOptions = [])
    {
        $this->accessToken = $accessToken;
        $this->sandbox = $sandbox;
        $this->httpOptions = $httpOptions;
    }

    public function withHttpOptions(array $httpOptions)
    {
        $clone = clone $this;
        $clone->httpOptions = array_merge($this->httpOptions, $httpOptions);

        return $clone;
    }

    public function withTimeout($timeout, $connectTimeout = null)
    {
        $httpOptions = ['timeout' => $timeout];

        if ($connectTimeout !== null) {
            $httpOptions['connect_timeout'] = $connectTimeout;
        }

        return $this->withHttpOptions($httpOptions);
    }

    public function customer()
    {
        return new Customer($this->accessToken, $this->sandbox, $this->httpOptions);
    }

    public function subscription()
    {
        return new Subscription($this->accessToken, $this->sandbox, $this->httpOptions);
    }

    public function payment()
    {
        return new Payment($this->accessToken, $this->sandbox, $this->httpOptions);
    }

    public function installment()
    {
        return new Installment($this->accessToken, $this->sandbox, $this->httpOptions);
    }

    public function notification()
    {
        return new Notification($this->accessToken, $this->sandbox, $this->httpOptions);
    }

    public function creditCard()
    {
        return new CreditCard($this->accessToken, $this->sandbox, $this->httpOptions);
    }
}