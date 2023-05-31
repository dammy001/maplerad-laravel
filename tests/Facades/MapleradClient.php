<?php

use Illuminate\Config\Repository;
use Maplerad\Laravel\Facades\MapleradClient;
use Maplerad\Laravel\MapleradServiceProvider;
use Maplerad\Laravel\Resources\Banking;
use Maplerad\Laravel\Resources\Bills;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\FX;
use Maplerad\Laravel\Resources\Issuing;
use Maplerad\Laravel\Resources\Wallet;

beforeEach(function () {
    $app = app();

    $app->bind('config', fn () => new Repository([
        'maplerad' => [
            'secret_key' => 'test',
        ],
    ]));

    (new MapleradServiceProvider($app))->register();

    MapleradClient::setFacadeApplication($app);
});

it('resolves Maplerad client', function () {
    expect(MapleradClient::getFacadeRoot())
        ->toBeInstanceOf(\Maplerad\Laravel\Transporters\MapleradClient::class);
});

it('can get an API service', function () {
    expect(MapleradClient::customers())->toBeInstanceOf(Customers::class)
        ->and(MapleradClient::issuing())->toBeInstanceOf(Issuing::class)
        ->and(MapleradClient::fx())->toBeInstanceOf(FX::class)
        ->and(MapleradClient::bills())->toBeInstanceOf(Bills::class)
        ->and(MapleradClient::wallet())->toBeInstanceOf(Wallet::class)
        ->and(MapleradClient::banking())->toBeInstanceOf(Banking::class);
});
