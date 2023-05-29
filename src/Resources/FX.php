<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\FX\QuoteResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class FX
{
    use Transportable;

    public function generateQuote(string $sourceCurrency, string $targetCurrency, float|int $amount)
    {
        $payload = Payload::create(
            'fx/quote',
            [
                'source_currency' => $sourceCurrency,
                'target_currency' => $targetCurrency,
                'amount' => $amount
            ]
        );

        $result = $this->transporter->post($payload->uri, $payload->parameters);

        return QuoteResponse::from((array) $result->json('data'));
    }

    public function exchangeCurrency()
    {

    }

    public function history()
    {

    }
}
