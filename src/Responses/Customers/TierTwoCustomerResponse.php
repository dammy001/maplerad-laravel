<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Customers;

use Maplerad\Laravel\Contracts\ResponseContract;

final class TierTwoCustomerResponse implements ResponseContract
{
    public function __construct(
        public readonly string $id,
        public readonly string $status
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['status']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
        ];
    }
}
