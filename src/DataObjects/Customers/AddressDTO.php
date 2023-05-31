<?php

declare(strict_types=1);

namespace Maplerad\Laravel\DataObjects\Customers;

use Maplerad\Laravel\Contracts\ResponseContract;

final class AddressDTO implements ResponseContract
{
    public function __construct(
        public readonly string $street,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country,
        public readonly string $postalCode,
        public readonly ?string $street2 = '',
    ) {
    }

    public function toArray(): array
    {
        return [
            'street' => $this->street,
            'street2' => $this->street2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'postal_code' => $this->postalCode,
        ];
    }
}
