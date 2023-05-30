<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Wallet;

use Maplerad\Laravel\Contracts\ResponseContract;

final class ListHistoryResponse implements ResponseContract
{
    /**
     * @param array<int, HistoryResponse> $data
     */
    private function __construct(
        public readonly array $data,
        public readonly array $meta
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     */
    public static function from(array $attributes): self
    {
        $data = array_map(
            fn (array $attribute): HistoryResponse => HistoryResponse::from($attribute),
            $attributes['data']
        );

        return new self($data, $attributes['meta']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'data' => array_map(
                static fn (HistoryResponse $response): array => $response->toArray(),
                $this->data,
            ),
            'meta' => $this->meta
        ];
    }
}
