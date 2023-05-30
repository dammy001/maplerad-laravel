<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources\Banking;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\Banking\Deposit\CreateDepositResponse;
use Maplerad\Laravel\Responses\Banking\Deposit\ListAccountsResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Deposit
{
    use Transportable;

    /**
     * enables the creation of a deposit account.
     *
     * @see https://maplerad.dev/reference/create-a-deposit-account
     *
     * @throws RequestException
     */
    public function create(string $customerId, string $currency): CreateDepositResponse
    {
        $payload = Payload::create(
            'accounts',
            ['customer_id' => $customerId, 'currency' => $currency]
        );

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return CreateDepositResponse::from((array) $result->json('data'));
    }

    /**
     * get an account by currency type.
     *
     * @see https://maplerad.dev/reference/get-accounts-by-currency
     *
     * @throws RequestException
     */
    public function account(string $accountId, string $currency): CreateDepositResponse
    {
        $payload = Payload::list("accounts/$accountId/$currency");

        $result = $this->transporter->get($payload->uri)->throw();

        return CreateDepositResponse::from((array) $result->json('data'));
    }

    /**
     * Get all deposit accounts created
     *
     * @see https://maplerad.dev/reference/get-accounts
     *
     * @throws RequestException
     */
    public function accounts(string|null $accountId = ''): ListAccountsResponse
    {
        $payload = Payload::list("accounts/$accountId");

        $result = $this->transporter->get($payload->uri)->throw();

        return ListAccountsResponse::from((array) $result->json('data'));
    }
}
