<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Miscellaneous\Currency;

use Maplerad\Laravel\Contracts\ResponseContract;

final class CurrencyResponse implements ResponseContract
{
    public function __construct(
        public readonly string $name,
        public readonly string $currency,
        public readonly string $symbol
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['currency'],
            $attributes['symbol']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'currency' => $this->currency,
            'symbol' => $this->symbol
        ];
    }
}
