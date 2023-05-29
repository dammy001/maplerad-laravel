<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Enums\Resources\Transfer\Currency;
use Maplerad\Laravel\Enums\Resources\Transfer\DOMScheme;
use Maplerad\Laravel\Responses\Transfers\SenderPayloadResponse;
use Maplerad\Laravel\Responses\Transfers\CreateTransferResponse;
use Maplerad\Laravel\Responses\Transfers\TransferResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Transfers
{
    use Transportable;

    /**
     * Enables a bank transfer from your maplerad balance.
     *
     * @see https://maplerad.dev/reference/create-a-transfer
     *
     * @throws RequestException
     */
    public function create(
        string $bankCode,
        string $accountNumber,
        int|float $amount,
        string $currency,
        string|null $reason = null,
        string|null $reference = null,
        array|null $meta = null
    ): CreateTransferResponse {
        $payload = Payload::create('transfers', [
            'bank_code' => $bankCode,
            'account_number' => $accountNumber,
            'amount' => $amount,
            'currency' => Currency::from($currency)->value,
            'reason' => $reason,
            'reference' => $reference,
            ...(! empty($meta) ? [
                'scheme' => DOMScheme::from($meta['scheme'])->value,
                'sender' => SenderPayloadResponse::from($meta['sender'])->toArray(),
                'counterparty' => SenderPayloadResponse::from($meta['counter_party'])
            ] : [])
        ]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return CreateTransferResponse::from(attributes: (array) $result->json('data'));
    }

    /**
     * Get a list of all transfers that have been made
     *
     * @see https://maplerad.dev/reference/get-transfers
     *
     * @throws RequestException
     */
    public function list(): mixed
    {
        $payload = Payload::list('transfers');

        return $this->transporter->get($payload->uri)->throw()->json('data');
    }

    /**
     * Verify a transfer using its reference or id.
     *
     * @see https://maplerad.dev/reference/get-transfer-by-id
     *
     * @throws RequestException
     */
    public function verify(string $transferId): TransferResponse
    {
        $payload = Payload::retrieve('transfers', $transferId);

        $result = $this->transporter->get($payload->uri)->throw();

        return TransferResponse::from(attributes: (array) $result->json('data'));
    }
}
