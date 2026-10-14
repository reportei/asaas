<?php

use Reportei\Asaas\Services\Api;

test("if the http client gives up on a slow Asaas instead of waiting forever", function () {
    $api = new Api(ACCESS_TOKEN, SANDBOX);
    $client = (fn () => $this->client)->call($api);

    expect($client->getConfig('connect_timeout'))->toBe(Api::CONNECT_TIMEOUT_SECONDS);
    expect($client->getConfig('timeout'))->toBe(Api::TIMEOUT_SECONDS);
});
