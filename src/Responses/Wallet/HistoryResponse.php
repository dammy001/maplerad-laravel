<?php

declare(strict_types=1);

namespace Maplerad\Laravel\Responses\Wallet;

use Maplerad\Laravel\Contracts\ResponseContract;

final class HistoryResponse implements ResponseContract
{
    public function __construct(
        public readonly string $transactionId,
        public readonly string|null $relatedTransactionId,
        public readonly string $walletId,
        public readonly int|float $debit,
        public readonly int|float $credit,
        public readonly int|float $previousBalance,
        public readonly int|float $currentBalance,
        public readonly string $balanceType,
        public readonly bool $reversal,
        public readonly mixed $transaction,
        public readonly string $createdAt,
        public readonly string $updatedAt
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['transaction_id'],
            $attributes['related_transaction_id'],
            $attributes['wallet_id'],
            $attributes['debit'],
            $attributes['credit'],
            $attributes['previous_balance'],
            $attributes['current_balance'],
            $attributes['balance_type'],
            $attributes['reversal'],
            $attributes['transaction'],
            $attributes['created_at'],
            $attributes['updated_at']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'related_transaction_id' => $this->relatedTransactionId,
            'wallet_type' => $this->walletId,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'previous_balance' => $this->previousBalance,
            'current_balance' => $this->currentBalance,
            'balance_type' => $this->balanceType,
            'reversal' => $this->reversal,
            'transaction' => $this->transaction,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
}
