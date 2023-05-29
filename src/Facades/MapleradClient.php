<?php

namespace Maplerad\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Maplerad\Laravel\Resources\Customers;

final class MapleradClient extends Facade
{
    public static function customers(): Customers
    {
        return MapleradClient::getFacadeRoot()->customers();
    }

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'maplerad';
    }
}