<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\Miscellaneous\Currency\CurrenciesResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Miscellaneous
{
    use Transportable;

    /**
     * Get list of available currencies
     *
     * @see https://maplerad.dev/reference/get-all-currencies
     *
     * @throws RequestException
     */
    public function currencies(): CurrenciesResponse
    {
        $payload = Payload::list('currencies');

        $result = $this->transporter->get($payload->uri)->throw();

        return CurrenciesResponse::from(attributes: (array) $result->json('data'));
    }

    /**
     * Get list of available countries
     *
     * @see https://maplerad.dev/reference/get-all-countries
     *
     * @throws RequestException
     */
    public function countries(): array
    {
        $payload = Payload::list('countries');

        $result = $this->transporter->get($payload->uri)->throw();

        return (array) $result->json('data');
    }

    /**
     * Verify bank account
     *
     * @see https://maplerad.dev/reference/resolve-institution-account
     *
     * @throws RequestException
     */
    public function resolveAccount(string|int $accountNumber, string|int $bankCode): array
    {
        $payload = Payload::create(
            'institutions/resolve',
            ['account_number' => (string) $accountNumber, 'bank_code' => (string) $bankCode]
        );

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return (array) $result->json('data');
    }
}
