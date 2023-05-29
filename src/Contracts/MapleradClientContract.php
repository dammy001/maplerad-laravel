<?php

namespace Maplerad\Laravel\Contracts;

use Illuminate\Http\Client\PendingRequest;
use Maplerad\Laravel\Resources\Banking;
use Maplerad\Laravel\Resources\Bills;
use Maplerad\Laravel\Resources\Customers;
use Maplerad\Laravel\Resources\FX;
use Maplerad\Laravel\Resources\Identity;
use Maplerad\Laravel\Resources\Issuing;
use Maplerad\Laravel\Resources\Miscellaneous;
use Maplerad\Laravel\Resources\Transactions;
use Maplerad\Laravel\Resources\Transfers;

interface MapleradClientContract
{
    /**
     * Return the current PendingRequest object
     *
     */
    public function request(): PendingRequest;

    /**
     * Return the customer object
     *
     */
    public function customers(): Customers;

    /**
     * Return the banking object
     *
     */
    public function banking(): Banking;

    /**
     * Return the banking object
     *
     */
    public function bills(): Bills;

    /**
     * Return the issuing object
     *
     */
    public function issuing(): Issuing;

    /**
     * Return the transfers object
     *
     */
    public function transfers(): Transfers;

    /**
     * Return the transactions object
     *
     */
    public function transactions(): Transactions;

    /**
     * Return the FX object
     *
     */
    public function fx(): FX;

    /**
     * Return the identity object
     *
     */
    public function identity(): Identity;

    /**
     * Return the miscellaneous object
     *
     */
    public function miscellaneous(): Miscellaneous;
}