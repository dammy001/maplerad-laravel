<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Exceptions;

use Exception;

final class ConfigurationException extends Exception
{
    public static function noSecretKey(): ConfigurationException
    {
        return new ConfigurationException(
            message: 'Secret Key is missing. Ensure this is set.',
        );
    }
}