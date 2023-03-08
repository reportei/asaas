<?php

namespace Reportei\Asaas;

use Illuminate\Support\ServiceProvider;
use Reportei\Asaas\Services\Api;
use Reportei\Asaas\Services\Customer;
use Reportei\Asaas\Services\Subscription;
use Reportei\Asaas\Services\Payment;

class AsaasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(Asaas::class, function ($app) {
            return new Asaas();
        });

        $this->app->bind(Api::class, function ($app) {
            return new Api();
        });
    
        $this->app->bind(Customer::class, function ($app) {
            return new Customer();
        });
    
        $this->app->bind(Payment::class, function ($app) {
            return new Payment();
        });
    
        $this->app->bind(Subscription::class, function ($app) {
            return new Subscription();
        });
    }
}