<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Issuing;

final class CardResponse
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $cardNumber,
        public readonly string $maskedPan,
        public readonly string $expiry,
        public readonly string $cvv,
        public readonly string $status,
        public readonly string $type,
        public readonly string $issuer,
        public readonly string $currency,
        public readonly int|float $balance,
        public readonly bool $autoApprove,
        public readonly array $address,
        public readonly string $createdAt
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['name'],
            $attributes['card_number'],
            $attributes['masked_pan'],
            $attributes['expiry'],
            $attributes['cvv'],
            $attributes['status'],
            $attributes['type'],
            $attributes['issuer'],
            $attributes['currency'],
            (float) $attributes['balance'],
            $attributes['auto_approve'],
            (array) $attributes['address'],
            $attributes['created_at']
        );
    }
}
