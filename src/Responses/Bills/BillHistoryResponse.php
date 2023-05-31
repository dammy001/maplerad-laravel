<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Bills;

final class BillHistoryResponse
{
    /**
     * @param array<int, AirtimeResponse> $data
     * @param array $meta
     */
    public function __construct(
        public readonly array $data,
        public readonly array $meta
    ) {
    }

    public static function from(array $attributes): self
    {
        $data = array_map(
            fn (array $attribute): AirtimeResponse => AirtimeResponse::from($attribute),
            $attributes['data']
        );

        return new self($data, $attributes['meta']);
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(fn (AirtimeResponse $attribute) => $attribute->toArray(), $this->data),
            'meta' => $this->meta
        ];
    }
}