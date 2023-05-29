<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Enums\Transporters;

/**
 * @internal
 */
enum Method: string
{
    case GET = 'GET';

    case POST = 'POST';

    case PUT = 'PUT';

    case DELETE = 'DELETE';

    case PATCH = 'PATCH';
}
