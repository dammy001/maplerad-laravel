<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Transfers;

final class CreateTransferResponse
{
    public function __construct(
        public readonly string $bankCode,
        public readonly string $accountNumber,
        public readonly int|float $amount,
        public readonly string $currency,
        public readonly string $reference,
        public readonly string|null $reason,
        public readonly array $meta
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['bank_code'],
            $attributes['account_number'],
            (float) $attributes['amount'],
            $attributes['currency'],
            $attributes['reference'],
            $attributes['reason'] ?? null,
            ! empty($attributes['meta'])
                ? [
                    'scheme' => $attributes['meta']['scheme'],
                    'sender' => SenderPayloadResponse::from($attributes['meta']['sender']),
                    'counterparty' => SenderPayloadResponse::from($attributes['meta']['counterparty'])
            ] : []
        );
    }
}
