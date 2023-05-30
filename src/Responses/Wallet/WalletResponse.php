<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Wallet;

use Maplerad\Laravel\Contracts\ResponseContract;

final class WalletResponse implements ResponseContract
{
    public function __construct(
        public readonly string $id,
        public readonly string $currency,
        public readonly int|float $ledgerBalance,
        public readonly int|float $availableBalance,
        public readonly int|float $holdingBalance,
        public readonly bool $active,
        public readonly bool $disabled,
        public readonly string $walletType
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['currency'],
            $attributes['ledger_balance'],
            $attributes['available_balance'],
            $attributes['holding_balance'],
            $attributes['active'],
            $attributes['disabled'],
            $attributes['wallet_type']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'currency' => $this->currency,
            'ledger_balance' => $this->ledgerBalance,
            'available_balance' => $this->availableBalance,
            'holding_balance' => $this->holdingBalance,
            'active' => $this->active,
            'disabled' => $this->disabled,
            'wallet_type' => $this->walletType
        ];
    }
}
