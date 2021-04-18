<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Refund
 *
 * @property int $id
 * @property int $transaction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Transaction $transaction
 * @method static Builder|Refund newModelQuery()
 * @method static Builder|Refund newQuery()
 * @method static Builder|Refund query()
 * @method static Builder|Refund whereCreatedAt($value)
 * @method static Builder|Refund whereId($value)
 * @method static Builder|Refund whereTransactionId($value)
 * @method static Builder|Refund whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Refund extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
