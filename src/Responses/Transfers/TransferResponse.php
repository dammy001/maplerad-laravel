<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Transfers;

final class TransferResponse
{
    public function __construct(
        public readonly string $id,
        public readonly string $accountNumber,
        public readonly string $bankCode,
        public readonly string $currency,
        public readonly string $status,
        public readonly string $entry,
        public readonly string $type,
        public readonly int|float $amount,
        public readonly string $summary,
        public readonly string $reason,
        public readonly int|float $fee
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['account_number'],
            $attributes['bank_code'],
            $attributes['currency'],
            $attributes['status'],
            $attributes['entry'],
            $attributes['type'],
            $attributes['amount'],
            $attributes['summary'],
            $attributes['reason'],
            $attributes['fee']
        );
    }
}
