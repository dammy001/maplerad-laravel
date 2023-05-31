<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Maplerad\Laravel\Resources\Banking;
use Maplerad\Laravel\Resources\Bills;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\FX;
use Maplerad\Laravel\Resources\Identity;
use Maplerad\Laravel\Resources\Issuing;
use Maplerad\Laravel\Resources\Transfers;
use Maplerad\Laravel\Resources\Wallet;

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

    public static function banking(): Banking
    {
        return MapleradClient::getFacadeRoot()->banking();
    }

    public static function bills(): Bills
    {
        return MapleradClient::getFacadeRoot()->bills();
    }

    public static function fx(): FX
    {
        return MapleradClient::getFacadeRoot()->fx();
    }

    public static function identity(): Identity
    {
        return MapleradClient::getFacadeRoot()->identity();
    }

    public static function transfers(): Transfers
    {
        return MapleradClient::getFacadeRoot()->transfers();
    }

    public static function wallet(): Wallet
    {
        return MapleradClient::getFacadeRoot()->wallet();
    }

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'maplerad';
    }

//    /**
//     * @param  array<array-key, mixed> $responses
//     */
//    public static function fake(array $responses = []) /** @phpstan-ignore-line */
//    {
//        $fake = new OpenAIFake($responses);
//        self::swap($fake);
//
//        return $fake;
//    }
}
