<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Issuing;

final class CreateCardResponse
{
    public function __construct(public readonly string $reference)
    {
    }

    public static function from(array $attributes): CreateCardResponse
    {
        return new self(
            $attributes['reference']
        );
    }
}
