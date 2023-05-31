<?php

namespace Maplerad\Laravel\Concerns;

use Illuminate\Http\Client\PendingRequest;

trait Transportable
{
    use ValidatesResponse;

    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly PendingRequest $transporter)
    {
        // ..
    }
}
