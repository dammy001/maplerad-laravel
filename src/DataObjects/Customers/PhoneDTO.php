<?php

declare(strict_types=1);

namespace Maplerad\Laravel\DataObjects\Customers;

use Maplerad\Laravel\Contracts\ResponseContract;

final class PhoneDTO implements ResponseContract
{
    public function __construct(
        public readonly string $phoneCountryCode,
        public readonly string $phoneNumber
    ) {
    }

    public static function make(string $phoneCountryCode, string $phoneNumber): PhoneDTO
    {
        return new self($phoneCountryCode, $phoneNumber);
    }

    public function toArray(): array
    {
        return [
            'phone_country_code' => $this->phoneCountryCode,
            'phone_number' => $this->phoneNumber
        ];
    }
}
