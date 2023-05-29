<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Contracts;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @template TArray of array
 *
 * @extends Arrayable
 *
 * @internal
 */
interface ResponseContract extends Arrayable
{
    /**
     * Returns the array representation of the Response.
     *
     * @return TArray
     */
    public function toArray(): array;
}
