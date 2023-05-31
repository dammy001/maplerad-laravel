<?php

declare(strict_types=1);

namespace Maplerad\Laravel\DataObjects\Customers;

final class CreateCustomerDTO
{
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $identificationNumber,
        string $dateOfBirth,
        PhoneDTO $phone,
        AddressDTO $address,
        IdentityDTO $identity,
        ?string $photo = null
    ) {
    }
}
