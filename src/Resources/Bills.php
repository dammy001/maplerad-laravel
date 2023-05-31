<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\Bills\AirtimeResponse;
use Maplerad\Laravel\Responses\Bills\BillerListResponse;
use Maplerad\Laravel\Responses\Bills\BillHistoryResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Bills
{
    use Transportable;

    /**
     * Returns a list of billers available.
     *
     * @see https://maplerad.dev/reference/get-billers
     *
     * @throws RequestException
     */
    public function billers(string $country): BillerListResponse
    {
        $payload = Payload::retrieve(uri: 'bills/airtime/billers', param: $country);

        $result = $this->transporter->get($payload->uri)->throw();

        return BillerListResponse::from((array) $result->json('data'));
    }

    /**
     * Buy airtime from list of billers available.
     *
     * @see https://maplerad.dev/reference/buy-airtime
     *
     * @throws RequestException
     */
    public function airtime(string $phoneNumber, int|float $amount, string $identifier): AirtimeResponse
    {
        $payload = Payload::create(
            uri: 'bills/airtime',
            parameters: ['phone_number' => $phoneNumber, 'amount' => $amount, 'identifier' => $identifier]
        );

        $result = $this->transporter
            ->post($payload->uri, $payload->parameters)
            ->throw();

        return AirtimeResponse::from((array) $result->json('data'));
    }

    /**
     * retrieves all airtime purchase history
     *
     * @see https://maplerad.dev/reference/get-airtime-history
     *
     * @throws RequestException
     */
    public function history(int $page = 1): BillHistoryResponse
    {
        $payload = Payload::list('bills/airtime');

        $result = $this->transporter
            ->withOptions(['query' => ['page' => $page]])
            ->get($payload->uri)
            ->throw();

        return BillHistoryResponse::from((array) $result->json());
    }
}
