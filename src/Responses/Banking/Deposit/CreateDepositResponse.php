<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Banking\Deposit;

use Maplerad\Laravel\Contracts\ResponseContract;

final class CreateDepositResponse implements ResponseContract
{
    public function __construct(
        public readonly string $id,
        public readonly int|float $balance,
        public readonly array $accounts = []
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['balance'],
            $attributes['accounts']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'accounts' => $this->accounts
        ];
    }
}