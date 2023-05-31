<?php

declare(strict_types=1);

namespace Maplerad\Laravel\DataObjects\Customers;

use Maplerad\Laravel\Contracts\ResponseContract;

final class IdentityDTO implements ResponseContract
{
    public function __construct(
        public readonly string $type,
        public readonly string $image,
        public readonly string $number,
        public readonly string $country
    ) {
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'image' => $this->image,
            'number' => $this->number,
            'country' => $this->country
        ];
    }
}
