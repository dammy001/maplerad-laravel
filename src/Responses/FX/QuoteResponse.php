<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\FX;

final class QuoteResponse
{
    public function __construct(
        public readonly array $source,
        public readonly array $target,
        public readonly int|float $rate,
        public readonly string|null $reference,
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            QuoteResponse::toReadable($attributes['source']),
            QuoteResponse::toReadable($attributes['target']),
            $attributes['rate'],
            $attributes['reference'] ?? null,
        );
    }

    private static function toReadable(array $attributes): array
    {
        return [
            'currency' => $attributes['currency'],
            'amount' => (float) $attributes['amount'],
            'human_readable_amount' => (float) $attributes['human_readable_amount'],
        ];
    }
}
