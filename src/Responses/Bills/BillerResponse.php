<?php

namespace Maplerad\Laravel\Responses\Bills;

use Maplerad\Laravel\Contracts\ResponseContract;

final class BillerResponse implements ResponseContract
{
    public function __construct(
        public readonly string $name,
        public readonly string $identifier,
        public readonly int $commission
    ) {
    }

    public static function from(array $attribute): self
    {
        return new self(
            $attribute['name'],
            $attribute['identifier'],
            $attribute['commission']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'identifier' => $this->identifier,
            'commission' => $this->commission
        ];
    }
}