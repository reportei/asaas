<?php

use Reportei\Asaas\Asaas;
use Reportei\Asaas\Services\Customer;

beforeEach(function () {
    $this->asaas = new Asaas(ACCESS_TOKEN, SANDBOX);
    $this->customer = $this->asaas->customer();
    $this->data = [
        "name" => "Customer Test",
        "cpfCnpj" => "51489487018",
        "email" => "test@test.com",
        "mobilePhone" => "123456789",
        "postalCode" => "89223005",
        "addressNumber" => "277",
        "complement" => "Sl. 820",
        "externalReference" => "2"
    ];
});

test("if the getById method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "getById"));
});

test("if the getByEmail method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "getByEmail"));
});

test("if the getByCpfCnpj method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "getByCpfCnpj"));
});

test("if the getAll method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "getAll"));
});

test("if the create method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "create"));
});

test("if the update method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "update"));
});

test("if the delete method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "update"));
});

test("if the restore method exists in the customer class", function () {
    expect(true)->toBe(method_exists($this->customer, "update"));
});

test("if the customer is returned by id", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("id");
    $response = $this->customer->getById($customer->id);
    expect($response)->toHaveProperty("id");
    expect($customer->id)->toBe($response->id);

    $this->customer->delete($customer->id);
});

test("if the customer is returned by email", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("email");
    $response = $this->customer->getByEmail($customer->email);
    expect($response)->toHaveProperty("email");
    expect($customer->email)->toBe($response->email);

    $this->customer->delete($customer->id);
});

test("if the customer is returned by cpf", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("cpfCnpj");
    $response = $this->customer->getByCpfCnpj($customer->cpfCnpj);
    expect($response)->toHaveProperty("cpfCnpj");
    expect($customer->cpfCnpj)->toBe($response->cpfCnpj);

    $this->customer->delete($customer->id);
});

test("if getAll returns an array of customers", function () {
    $customer1 = $this->customer->create($this->data);
    $customer2 = $this->customer->create($this->data);
    $customer3 = $this->customer->create($this->data);

    $response = $this->customer->getAll();
    expect(is_array($response))->toBeTrue();
    expect(count($response))->toBeGreaterThanOrEqual(3);
    foreach ($response as $customer) {
        expect($customer)->toHaveProperty("id");
    }

    $this->customer->delete($customer1->id);
    $this->customer->delete($customer2->id);
    $this->customer->delete($customer3->id);
});

test("if the customer is created", function () {
    $customer = $this->customer->create($this->data);

    expect(is_object($customer))->toBeTrue();
    expect($customer)->toHaveProperty("id");
    expect($customer->id)->toMatch("/cus/");

    $this->customer->delete($customer->id);
});

test("if the customer been updated", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("id");
    expect($customer)->toHaveProperty("name");
    $data = $this->data;
    $data["name"] = "test name updated";
    $response = $this->customer->update($customer->id, $data);
    expect($response)->toHaveProperty("name");
    expect($response->name)->toBe($data["name"]);

    $this->customer->delete($customer->id);
});

test("if the customer been deleted", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("id");
    $response = $this->customer->delete($customer->id);
    expect($response)->toHaveProperty("deleted");
    expect(true)->toBe($response->deleted);
});

test("if the customer been restored", function () {
    $customer = $this->customer->create($this->data);

    expect($customer)->toHaveProperty("id");
    $response = $this->customer->delete($customer->id);
    expect($response)->toHaveProperty("deleted");
    expect(true)->toBe($response->deleted);

    $response = $this->customer->restore($customer->id);
    expect($response)->toHaveProperty("deleted");
    expect(false)->toBe($response->deleted);
});