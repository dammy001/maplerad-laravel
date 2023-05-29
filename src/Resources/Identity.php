<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Illuminate\Http\Client\RequestException;
use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Responses\Identity\VerifyBvnResponse;
use Maplerad\Laravel\ValueObjects\Transporter\Payload;

final class Identity
{
    use Transportable;

    /**
     * @throws RequestException
     */
    public function verifyBvn(string $bvn)
    {
        $payload = Payload::create('identity/bvn', ['bvn' => $bvn]);

        $result = $this->transporter
            ->post($payload->uri, $payload->parameters)
            ->throwIfServerError();

        return VerifyBvnResponse::from(attributes: (array) $result->json('data'));
    }
}
