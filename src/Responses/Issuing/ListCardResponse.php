<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Issuing;

final class ListCardResponse
{
    public function __construct(
        public readonly array $data,
        public readonly array $meta
    ) {
    }

    public static function from(array $attributes): self
    {
        $data = array_map(
            fn (array $attribute): CardResponse => CardResponse::from($attribute),
            $attributes['data']
        );

        return new self($data, $attributes['meta']);
    }
}
