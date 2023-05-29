<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Transporters;

use Illuminate\Http\Client\PendingRequest;
use Maplerad\Laravel\Contracts\MapleradClientContract;
use Maplerad\Laravel\Resources\Banking;
use Maplerad\Laravel\Resources\Bills;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\FX;
use Maplerad\Laravel\Resources\Identity;
use Maplerad\Laravel\Resources\Issuing;
use Maplerad\Laravel\Resources\Miscellaneous;
use Maplerad\Laravel\Resources\Transfers;
use Maplerad\Laravel\Resources\Transactions;
use Maplerad\Laravel\Resources\Wallet;

final class MapleradClient implements MapleradClientContract
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly PendingRequest $transporter)
    {
        // ..
    }

    /**
     * Returns customer class instance.
     */
    public function customers(): Customers
    {
        return new Customers($this->transporter);
    }

    /**
     * Returns bills class instance.
     */
    public function bills(): Bills
    {
        return new Bills($this->transporter);
    }

    /**
     * Returns banking class instance.
     */
    public function banking(): Banking
    {
        return new Banking($this->transporter);
    }

    /**
     * Returns identity class instance.
     */
    public function identity(): Identity
    {
        return new Identity($this->transporter);
    }

    /**
     * Returns issuing class instance.
     */
    public function issuing(): Issuing
    {
        return new Issuing($this->transporter);
    }

    /**
     * Returns transactions class instance.
     */
    public function transactions(): Transactions
    {
        return new Transactions($this->transporter);
    }

    /**
     * Returns fx class instance.
     */
    public function fx(): FX
    {
        return new FX($this->transporter);
    }

    /**
     * Returns transfers class instance.
     */
    public function transfers(): Transfers
    {
        return new Transfers($this->transporter);
    }

    /**
     * Returns miscellaneous class instance.
     */
    public function miscellaneous(): Miscellaneous
    {
        return new Miscellaneous($this->transporter);
    }

    /**
     * Returns wallet class instance.
     */
    public function wallet(): Wallet
    {
        return new Wallet($this->transporter);
    }

    /**
     * Returns pending http instance.
     */
    public function request(): PendingRequest
    {
        return $this->transporter;
    }
}
