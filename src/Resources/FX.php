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
     * Generates a foreign exchange quote.
     * Generating a quote is the first step to processing a currency exchange
     *
     * @see https://maplerad.dev/reference/generate-fx-quote
     *
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
     * Processes the currency exchange
     *
     * @see https://maplerad.dev/reference/exchange-currency
     *
     * @throws RequestException
     */
    public function exchangeCurrency(string $reference): QuoteResponse
    {
        $payload = Payload::create('fx', ['quote_reference' => $reference]);

        $result = $this->transporter->post($payload->uri, $payload->parameters)->throw();

        return QuoteResponse::from((array) $result->json('data'));
    }

    /**
     * Get a list of all FX transactions processed.
     *
     * @see https://maplerad.dev/reference/get-fx-history
     *
     * @throws RequestException
     */
    public function history(): mixed
    {
        $payload = Payload::list('fx');

        return $this->transporter->get($payload->uri)->throw()->json('data');
    }
}
