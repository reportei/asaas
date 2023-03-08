<?php

namespace Reportei\Asaas\Providers;

use Illuminate\Support\ServiceProvider;

class AsaasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('asaas', function () {
            return new \Reportei\Asaas\Asaas();
        });

        $this->app->singleton('api', function () {
            return new \Reportei\Asaas\Services\Api();
        });
    
        $this->app->singleton('customer', function () {
            return new \Reportei\Asaas\Services\Customer();
        });
    
        $this->app->singleton('payment', function () {
            return new \Reportei\Asaas\Services\Payment();
        });
    
        $this->app->singleton('subscription', function () {
            return new \Reportei\Asaas\Services\Subscription();
        });
    }
}