<?php

namespace Maplerad\Laravel\Concerns;

use Illuminate\Http\Client\PendingRequest;

trait Transportable
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly PendingRequest $transporter)
    {
        // ..
    }
}
