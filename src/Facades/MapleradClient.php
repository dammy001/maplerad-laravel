<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\Issuing;

final class MapleradClient extends Facade
{
    public static function customers(): Customers
    {
        return MapleradClient::getFacadeRoot()->customers();
    }

    public static function issuing(): Issuing
    {
        return MapleradClient::getFacadeRoot()->issuing();
    }

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'maplerad';
    }
}
