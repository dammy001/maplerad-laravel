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
     * @throws RequestException
     */
    public function currencies(): CurrenciesResponse
    {
        $payload = Payload::list('currencies');

        $result = $this->transporter->get($payload->uri)->throw();

        return CurrenciesResponse::from(attributes: (array) $result->json('data'));
    }
}
