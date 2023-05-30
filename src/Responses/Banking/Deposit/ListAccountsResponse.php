<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Banking\Deposit;

use Maplerad\Laravel\Contracts\ResponseContract;

final class ListAccountsResponse implements ResponseContract
{
    /**
     * @param  array<int, CreateDepositResponse> $data
     */
    private function __construct(
        public readonly array $data,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     */
    public static function from(array $attributes): self
    {
        $data = array_map(
            fn (array $attribute): CreateDepositResponse => CreateDepositResponse::from($attribute),
            $attributes
        );

        return new self($data);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'data' => array_map(
                static fn (CreateDepositResponse $response): array => $response->toArray(),
                $this->data,
            ),
        ];
    }
}