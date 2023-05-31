<?php

use Maplerad\Laravel\Resources\Banking;
use Maplerad\Laravel\Resources\Bills;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\FX;
use Maplerad\Laravel\Resources\Identity;
use Maplerad\Laravel\Resources\Issuing;
use Maplerad\Laravel\Resources\Miscellaneous;
use Maplerad\Laravel\Resources\Wallet;
use Maplerad\Laravel\Transporters\MapleradClient;
use Mockery as Mockery;
use Illuminate\Http\Client\PendingRequest;

beforeEach(function () {
    $this->transporter = Mockery::mock(PendingRequest::class);
    $this->client = new MapleradClient($this->transporter);
});

afterAll(function () {
    Mockery::close();
});

it('returns instance of maplerad client', function () {
    expect($this->client)->toBeInstanceOf(MapleradClient::class);
});

it('constructor returns an instance of pending request', function () {
    expect($this->transporter)->toBeInstanceOf(PendingRequest::class);
});

it('returns all client instances', function () {
    expect($this->client->customers())->toBeInstanceOf(Customers::class)
        ->and(expect($this->client->banking())->toBeInstanceOf(Banking::class))
        ->and(expect($this->client->fx())->toBeInstanceOf(FX::class))
        ->and(expect($this->client->issuing())->toBeInstanceOf(Issuing::class))
        ->and(expect($this->client->customers())->toBeInstanceOf(Customers::class))
        ->and(expect($this->client->bills())->toBeInstanceOf(Bills::class))
        ->and(expect($this->client->identity())->toBeInstanceOf(Identity::class))
        ->and(expect($this->client->wallet())->toBeInstanceOf(Wallet::class))
        ->and(expect($this->client->request())->toBeInstanceOf(PendingRequest::class))
        ->and(expect($this->client->miscellaneous())->toBeInstanceOf(Miscellaneous::class));
});
