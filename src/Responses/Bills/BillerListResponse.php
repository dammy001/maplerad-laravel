<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Bills;

final class BillerListResponse
{
    public function __construct(public readonly array $data)
    {
    }

    public static function from(array $attributes): self
    {
        $data = array_map(fn (array $attribute) => BillerResponse::from($attribute), $attributes);

        return new self($data);
    }
}
