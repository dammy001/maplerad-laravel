<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\FX\QuoteResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class FX
{
    use Transportable;

    /**
     * @throws RequestException
     */
    public function generateQuote(string $sourceCurrency, string $targetCurrency, float|int $amount): QuoteResponse
    {
        $payload = Payload::create(
            'fx/quote',
            [
                'source_currency' => $sourceCurrency,
                'target_currency' => $targetCurrency,
                'amount' => $amount
            ]
        );

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return QuoteResponse::from((array) $result->json('data'));
    }

    /**
     * @throws RequestException
     */
    public function exchangeCurrency(string $reference): QuoteResponse
    {
        $payload = Payload::create('fx', ['quote_reference' => $reference]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return QuoteResponse::from((array) $result->json('data'));
    }

    /**
     * @throws RequestException
     */
    public function history(): mixed
    {
        $payload = Payload::list('fx');

        return $this->transporter->get($payload->uri)->throw()->json('data');
    }
}
