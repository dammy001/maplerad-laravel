<?php

namespace Maplerad\Laravel\Responses\Customers;

use Maplerad\Laravel\Contracts\ResponseContract;

class CustomerResponse implements ResponseContract
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $country,
        public readonly string $status,
        public readonly int $tier,
        public readonly string $createdAt,
        public readonly string $updatedAt
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['country'],
            $attributes['status'],
            $attributes['tier'],
            $attributes['created_at'],
            $attributes['updated_at']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'country' => $this->country,
            'status' => $this->status,
            'tier' => $this->tier,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
}
