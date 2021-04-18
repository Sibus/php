<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionService
{
    public function create($userId, Request $request): Transaction
    {
        $attributes = Validator::validate($request->all(), [
            'value' => 'required|not_in:0|regex:/^\-?\d+(\.\d{1,2})?$/',
            'description' => 'required|string|max:10000',
        ]);

        $transaction = Transaction::make($attributes);
        $transaction->type = $transaction->value > 0 ? Transaction::TYPE_REFILL : Transaction::TYPE_DEBIT;
        $user = User::findOrFail($userId);

        return DB::transaction(function () use ($transaction, $user) {
            if ($transaction->isDebit() && $user->profile->cannotAfford($transaction->value)) {
                throw new \DomainException('Not enough balance');
            }
            $user->profile->addBalance($transaction->value);

            $success = $user->transactions()->save($transaction);
            $success = $success && $user->profile->save();
            if (!$success) {
                throw new \DomainException('Could not create transaction');
            }

            return $transaction;
        });
    }

    public function refund($transactionId): Transaction
    {
        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction->isRefunded()) {
            throw new \DomainException('Transaction is already refunded');
        }

        return DB::transaction(function () use ($transaction) {
            $profile = $transaction->user->profile;
            if ($transaction->isRefill() && $profile->cannotAfford(-$transaction->value)) {
                throw new \DomainException('Not enough balance');
            }
            $profile->addBalance(-$transaction->value);

            $success = $transaction->refund()->create();
            $success = $success && $profile->save();

            if (!$success) {
                throw new \DomainException('Could not refund transaction');
            }

            return $transaction;
        });
    }
}
