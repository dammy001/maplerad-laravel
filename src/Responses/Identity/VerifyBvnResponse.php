<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Identity;

use Maplerad\Laravel\Contracts\ResponseContract;

final class VerifyBvnResponse implements ResponseContract
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string|null $middleName,
        public readonly string|null $title,
        public readonly string|null $email,
        public readonly string|null $gender,
        public readonly string $dateOfBirth,
        public readonly string $phoneNumber,
        public readonly string|null $residentialAddress,
        public readonly string $enrollmentBank,
        public readonly string|null $enrollmentBranch,
        public readonly string|null $tier,
        public readonly string|null $stateOfOrigin,
        public readonly string|null $lga,
        public readonly string|null $stateOfResidence,
        public readonly string $maritalStatus,
        public readonly string $nationality,
        public readonly string|null $image,
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['middle_name'],
            $attributes['title'],
            $attributes['email'],
            $attributes['gender'],
            $attributes['dob'],
            $attributes['phone_number'],
            $attributes['residential_address'],
            $attributes['enrollment_bank'],
            $attributes['enrollment_branch'],
            $attributes['tier'],
            $attributes['state_of_origin'],
            $attributes['lga_of_origin'],
            $attributes['state_of_residence'],
            $attributes['marital_status'],
            $attributes['nationality'],
            $attributes['image'],
        );
    }

    public function toArray(): array
    {
        return [];
    }
}
