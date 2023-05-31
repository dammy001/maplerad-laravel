<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\DataObjects\Customers\AddressDTO;
use Maplerad\Laravel\DataObjects\Customers\IdentityDTO;
use Maplerad\Laravel\DataObjects\Customers\PhoneDTO;
use Maplerad\Laravel\Responses\Customers\CustomerResponse;
use Maplerad\Laravel\Responses\Customers\TierTwoCustomerResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Customers
{
    use Transportable;

    /**
     * Direct way to create a customer on Maplerad.
     * The customer will have access to all Maplerad resources including Issuing.
     *
     * @see https://maplerad.dev/reference/enroll-customer
     *
     * @throws RequestException
     */
    public function create(
        string $firstName,
        string $lastName,
        string $email,
        string $identificationNumber,
        string $dateOfBirth,
        PhoneDTO $phone,
        AddressDTO $address,
        IdentityDTO $identity,
        ?string $photo = null
    ): CustomerResponse {
        $payload = Payload::create("customers/enroll", [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'dob' => $dateOfBirth,
            'phone' => $phone->toArray(),
            'address' => $address->toArray(),
            'identity' => $identity->toArray(),
            'identification_number' => $identificationNumber,
            'photo' => $photo
        ]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return CustomerResponse::from((array) $result->json('data'));
    }

    /**
     * enables the creation of a new customer.
     * A customer ID is returned which can be used for further actions
     *
     * @see https://maplerad.dev/reference/create-a-customer
     *
     * @throws RequestException
     */
    public function createTierOne(
        string $firstName,
        string $lastName,
        string $email,
        string $country = 'NG'
    ): CustomerResponse {
        $payload = Payload::create('customers', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'country' => $country
        ]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return CustomerResponse::from((array) $result->json('data'));
    }

    /**
     * enables customer to be upgraded to tier one in order to process services like Collections
     *
     * @see https://maplerad.dev/reference/upgrade-customer-tier-1
     *
     * @throws RequestException
     */
    public function upgradeTierZeroToOne(
        string $customerId,
        string $dateOfBirth,
        PhoneDTO $phone,
        AddressDTO $address,
        string $identificationNumber,
        ?string $photo = null
    ): bool {
        $payload = Payload::create('customers/upgrade/tier1', [
            'customer_id' => $customerId,
            'dob' => $dateOfBirth,
            'phone' => $phone->toArray(),
            'address' => $address->toArray(),
            'identification_number' => $identificationNumber,
            'photo' => $photo
        ]);

        return $this->transporter->patch($payload->uri, $payload->parameters)->throw()->json('status');
    }

    /**
     * enables a customer to be upgraded to tier two which gives access to the Issuing API.
     *
     * @see https://maplerad.dev/reference/upgrade-customer-tier-2
     *
     * @throws RequestException
     */
    public function upgradeTierOneToTwo(
        string $customerId,
        IdentityDTO $identity,
        ?string $photo = null
    ): TierTwoCustomerResponse {
        $payload = Payload::create('customers/upgrade/tier2', [
            'customer_id' => $customerId,
            'identity' => $identity->toArray(),
            'photo' => $photo
        ]);

        $result = $this->transporter->patch($payload->uri, $payload->parameters)->throw();

        return TierTwoCustomerResponse::from((array) $result->json('data'));
    }

    /**
     * This resource allows a customer to be blacklisted
     *
     * @see https://maplerad.dev/reference/blacklist-a-customer
     *
     * @throws RequestException
     */
    public function blacklist(string $customerId): bool
    {
        $payload = Payload::create("customers/$customerId/active", [
            'blacklist' => true
        ]);

        return $this->transporter->post($payload->uri, $payload->parameters)->throw()->json('success');
    }

    /**
     * This resource allows a customer to be whitelisted
     *
     * @see https://maplerad.dev/reference/blacklist-a-customer
     *
     * @throws RequestException
     */
    public function whitelist(string $customerId): bool
    {
        $payload = Payload::create("customers/$customerId/active", [
            'blacklist' => false
        ]);

        return $this->transporter->post($payload->uri, $payload->parameters)->throw()->json('success');
    }
}
