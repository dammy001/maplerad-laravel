<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Enums\Resources\Issuing\Brand;
use Maplerad\Laravel\Enums\Resources\Issuing\Currency;
use Maplerad\Laravel\Responses\Issuing\CardResponse;
use Maplerad\Laravel\Responses\Issuing\CreateCardResponse;
use Maplerad\Laravel\Responses\Issuing\ListCardResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Issuing
{
    use Transportable;

    /**
     * Create a card for a customer.
     * This operation is asynchronous, meaning we notify you
     * via a webhook event on the final status
     *
     * @see https://maplerad.dev/reference/create-a-card
     *
     * @throws RequestException
     */
    public function create(
        string $customerId,
        string $currency,
        string $type,
        string $brand,
        int|float|null $amount = null
    ): CreateCardResponse {
        $payload = Payload::create('issuing', [
            'customer_id' => $customerId,
            'currency' => Currency::from($currency)->value,
            'brand' => Brand::from($brand)->value,
            'type' => $type,
            'auto_approve' => true,
            ...(! is_null($amount) ? ['amount' => $amount * 100] : [])
        ]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return CreateCardResponse::from(attributes: (array) $result->json('data'));
    }

    /**
     * enables a customer to credit their card with a specified amount
     *
     * @see https://maplerad.dev/reference/fund-a-card
     *
     * @throws RequestException
     */
    public function fund(string $cardId, int|float $amount): mixed
    {
        $payload = Payload::create("issuing/$cardId/fund", ['amount' => $amount * 100]);

        return $this->transporter->post($payload->uri, $payload->parameters)->throw()->json('data');
    }

    /**
     * enables a customer to withdraw a specified from their card
     *
     * @see https://maplerad.dev/reference/withdraw-from-a-card
     *
     * @throws RequestException
     */
    public function withdraw(string $cardId, int|float $amount): mixed
    {
        $payload = Payload::create("issuing/$cardId/withdraw", ['amount' => $amount * 100]);

        return $this->transporter->post($payload->uri, $payload->parameters)->throw()->json('data');
    }

    /**
     * allows a card created on Maplerad to be frozen. When a card is frozen,
     * no transaction (funding/withdrawal) will be allowed.
     *
     * @see https://maplerad.dev/reference/freeze-a-card
     *
     * @throws RequestException
     */
    public function freeze(string $cardId): bool
    {
        $payload = Payload::update("issuing/$cardId/freeze");

        return $this->transporter->patch($payload->uri)->throw()->json('status');
    }

    /**
     * allows a card created on Maplerad to be unfrozen. When a card is enabled,
     * all transactions (funding/withdrawal) will be allowed.
     *
     * @see https://maplerad.dev/reference/unfreeze-a-card
     *
     * @throws RequestException
     */
    public function unfreeze(string $cardId): bool
    {
        $payload = Payload::update("issuing/$cardId/unfreeze");

        return $this->transporter->patch($payload->uri)->throw()->json('status');
    }

    /**
     * get a card details
     *
     * @see https://maplerad.dev/reference/get-a-card
     *
     * @throws RequestException
     */
    public function card(string $cardId): CardResponse
    {
        $payload = Payload::list("issuing/$cardId");

        $result = $this->transporter->get($payload->uri)->throw();

        return CardResponse::from((array) $result->json('data'));
    }

    /**
     * get a list of all cards
     *
     * @see https://maplerad.dev/reference/get-all-cards
     *
     * @throws RequestException
     */
    public function cards(array $queryParams = []): ListCardResponse
    {
        $query = Arr::query([
            ...$queryParams,
            ...(empty($queryParams['page']) ? ['page' => 1] : [])
        ]);

        $payload = Payload::list("issuing?$query");

        $result = $this->transporter->get($payload->uri)->throw();

        return ListCardResponse::from((array) $result->json());
    }
}
