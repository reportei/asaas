<?php

use Reportei\Asaas\Asaas;

function clientOf($service)
{
    return (fn () => $this->client)->call($service);
}

test("if the http client keeps guzzle defaults when no options are given", function () {
    $client = clientOf((new Asaas(ACCESS_TOKEN, SANDBOX))->payment());

    expect($client->getConfig('timeout'))->toBeNull();
    expect($client->getConfig('connect_timeout'))->toBeNull();
});

test("if constructor options reach the http client of every service", function () {
    $asaas = new Asaas(ACCESS_TOKEN, SANDBOX, ['timeout' => 45]);

    foreach (['customer', 'subscription', 'payment', 'installment', 'notification', 'creditCard'] as $service) {
        expect(clientOf($asaas->{$service}())->getConfig('timeout'))->toBe(45);
    }
});

test("if withTimeout sets the timeouts on the http client", function () {
    $client = clientOf((new Asaas(ACCESS_TOKEN, SANDBOX))->withTimeout(15, 5)->payment());

    expect($client->getConfig('timeout'))->toBe(15);
    expect($client->getConfig('connect_timeout'))->toBe(5);
});

test("if withTimeout keeps the connect timeout from the constructor when omitted", function () {
    $asaas = new Asaas(ACCESS_TOKEN, SANDBOX, ['connect_timeout' => 3]);
    $client = clientOf($asaas->withTimeout(15)->payment());

    expect($client->getConfig('timeout'))->toBe(15);
    expect($client->getConfig('connect_timeout'))->toBe(3);
});

test("if withTimeout leaves the original instance untouched", function () {
    $asaas = new Asaas(ACCESS_TOKEN, SANDBOX);
    $asaas->withTimeout(15, 5);

    expect(clientOf($asaas->payment())->getConfig('timeout'))->toBeNull();
});
