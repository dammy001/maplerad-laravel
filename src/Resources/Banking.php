<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Resources;

use Maplerad\Laravel\Concerns\Transportable;
use Maplerad\Laravel\Resources\Banking\Collection;
use Maplerad\Laravel\Resources\Banking\Deposit;

final class Banking
{
    use Transportable;

    public function deposit(): Deposit
    {
        return new Deposit($this->transporter);
    }

    public function collection(): Collection
    {
        return new Collection($this->transporter);
    }
}
