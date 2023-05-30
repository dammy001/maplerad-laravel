<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Enums\Resources\Issuing\Currency;
use Maplerad\Laravel\Responses\Wallet\ListHistoryResponse;
use Maplerad\Laravel\Responses\Wallet\WalletResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Wallet
{
    use Transportable;

    /**
     * returns details about your business account
     *
     * @see https://maplerad.dev/reference/get-wallet
     *
     * @throws RequestException
     */
    public function list(): array
    {
        $payload = Payload::list('wallets');

        $result = $this->transporter->get($payload->uri)->throw();

        return array_map(
            fn (array $attribute): WalletResponse => WalletResponse::from((array) $attribute),
            $result->json('data')
        );
    }

    /**
     * get the history of transactions in a wallet.
     *
     * @see https://maplerad.dev/reference/get-wallet-history
     *
     * @throws RequestException
     */
    public function history(
        int $page = 1,
        int $pageSize = 10,
        string|Carbon|null $startDate = null,
        string|Carbon|null $endDate = null
    ): ListHistoryResponse {
        $query = Arr::query([
            'page' => $page,
            'page_size' => $pageSize,
            'start_date' => $startDate instanceof Carbon ? $startDate->toDateString() : $startDate,
            'end_date' => $endDate instanceof Carbon ? $endDate->toDateString() : $endDate
        ]);

        $payload = Payload::list("wallets/history?$query");

        $result = $this->transporter->get($payload->uri)->throw();

        return ListHistoryResponse::from((array) $result->json());
    }

    /**
     * get the history of transactions in a wallet by currency code.
     *
     * @see https://maplerad.dev/reference/get-wallets-history-by-currency-code
     *
     * @throws RequestException
     */
    public function historyByCurrency(
        string $currency = 'NGN',
        int $page = 1,
        int $pageSize = 10,
        string|Carbon|null $startDate = null,
        string|Carbon|null $endDate = null
    ): ListHistoryResponse {
        $query = Arr::query([
            'page' => $page,
            'page_size' => $pageSize,
            'start_date' => $startDate instanceof Carbon ? $startDate->toDateString() : $startDate,
            'end_date' => $endDate instanceof Carbon ? $endDate->toDateString() : $endDate
        ]);

        $payload = Payload::list("wallets/$currency/history?$query");

        $result = $this->transporter->get($payload->uri)->throw();

        return ListHistoryResponse::from((array) $result->json());
    }
}
