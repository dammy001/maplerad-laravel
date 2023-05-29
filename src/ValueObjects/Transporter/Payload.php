<?php

namespace Maplerad\Laravel\ValueObjects\Transporter;

use Maplerad\Laravel\Enums\Method;

/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        private readonly Method $method,
        private readonly string $uri,
        private readonly array $parameters = [],
    ) {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function create(string $uri, array $parameters): self
    {
        return new self(Method::POST, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function list(string $uri): self
    {
        return new self(Method::GET, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieve(string $uri, string $param, string $suffix = ''): self
    {
        return new self(Method::GET, "{$uri}/{$param}{$suffix}");
    }
}
