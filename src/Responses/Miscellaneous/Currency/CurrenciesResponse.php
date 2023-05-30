<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Miscellaneous\Currency;

use Maplerad\Laravel\Contracts\ResponseContract;

final class CurrenciesResponse implements ResponseContract
{
    public function __construct(public readonly array $currencies)
    {
    }

    public static function from(array $attributes): self
    {
        $currencies = ! empty($attributes) ? array_map(
            callback: fn (array $currency): array => CurrencyResponse::from($currency)->toArray(),
            array: $attributes
        ) : [];

        return new self($currencies);
    }

    public function toArray(): array
    {
        return [
            'currencies' => $this->currencies,
        ];
    }
}
