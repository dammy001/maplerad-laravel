<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Bills;

use Maplerad\Laravel\Contracts\ResponseContract;

final class AirtimeResponse implements ResponseContract
{
    public function __construct(
        public readonly string $id,
        public readonly int|float $amount,
        public readonly string $phoneNumber,
        public readonly string $network,
        public readonly int|float $debitAmount,
        public readonly int|float $commissionEarned
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            (float) $attributes['amount'],
            $attributes['phone_number'],
            $attributes['network'],
            $attributes['debit_amount'],
            $attributes['commission_earned']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'phone_number' => $this->phoneNumber,
            'network' => $this->network,
            'debit_amount' => $this->debitAmount,
            'commission_earned' => $this->commissionEarned
        ];
    }
}
