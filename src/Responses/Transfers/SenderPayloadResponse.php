<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Transfers;

use Maplerad\Laravel\Contracts\ResponseContract;

final class SenderPayloadResponse implements ResponseContract
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $phoneNumber,
        public readonly string $address,
        public readonly string $country
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['phone_number'],
            $attributes['address'],
            $attributes['country']
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone_number' => $this->phoneNumber,
            'address' => $this->address,
            'country' => $this->country
        ];
    }
}
