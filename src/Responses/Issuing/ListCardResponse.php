<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Issuing;

use Maplerad\Laravel\Contracts\ResponseContract;

final class ListCardResponse implements ResponseContract
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

    public function toArray(): array
    {
        return [
            'data' => array_map(fn (CardResponse $attribute) => $attribute->toArray(), $this->data),
            'meta' => $this->meta
        ];
    }
}
