<?php

use Reportei\Asaas\Asaas;
use Reportei\Asaas\Services\Customer;
use Reportei\Asaas\Services\Subscription;

beforeEach(function () {
    $this->asaas = new Asaas(ACCESS_TOKEN, SANDBOX);
});

test("if the assas object is an instance of the assas class", function () {
    expect($this->asaas)->toBeInstanceOf(Asaas::class);
});

test("if accessToken attribute exists in asaas class", function () {
    expect($this->asaas)->toHaveProperty("accessToken");
});

test("if sandbox attribute exists in asaas class", function () {
    expect($this->asaas)->toHaveProperty("sandbox");
});

test("if the customer method exists in the asaas class", function () {
    expect(true)->toBe(method_exists($this->asaas, "customer"));
});

test("if the customer method returns an instance of the customer class", function () {
    $customer = $this->asaas->customer();
    expect($customer)->toBeInstanceOf(Customer::class);
});

test("if the subscription method exists in the asaas class", function () {
    expect(true)->toBe(method_exists($this->asaas, "subscription"));
});

test("if the subscription method returns an instance of the subscription class", function () {
    $subscription = $this->asaas->subscription();
    expect($subscription)->toBeInstanceOf(Subscription::class);
});