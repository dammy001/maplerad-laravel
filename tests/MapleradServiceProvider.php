<?php

use Maplerad\Laravel\Contracts\MapleradClientContract;
use Maplerad\Laravel\Exceptions\ConfigurationException;
use Maplerad\Laravel\MapleradServiceProvider;
use Maplerad\Laravel\Transporters\MapleradClient;

it('requires an API Secret Key', function () {
    app()->get('maplerad');
})->throws(ConfigurationException::class);

it('provides', function () {
    $provider = app()->resolveProvider(MapleradServiceProvider::class);

    $provides = $provider->provides();

    expect($provides)->toBe([
        MapleradClient::class,
        MapleradClientContract::class,
        'maplerad'
    ]);
});
