<?php

declare(strict_types=1);

namespace Maplerad\Laravel;

final class Maplerad
{
    /**
     * Maplerad library version.
     */
    public const VERSION = '0.1.0';

    /**
     * Indicates if Maplerad routes will be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * Configure Maplerad to not register its routes.
     */
    public static function ignoreRoutes(): Maplerad
    {
        Maplerad::$registersRoutes = false;

        return new Maplerad;
    }
}
