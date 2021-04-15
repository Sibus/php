<?php

namespace App\Models;

use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property float $value Сумма транзакции
 * @property string $description Описание транзакции
 * @property int $type Тип транзакции
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static TransactionFactory factory(...$parameters)
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereDescription($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction whereType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @method static Builder|Transaction whereUserId($value)
 * @method static Builder|Transaction whereValue($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    /** @const пополнение счета */
    const TYPE_REFILL = 1;
    /** @const списание со счета */
    const TYPE_DEBIT = 2;
    /** @const Возвращаемая транзакция */
    const TYPE_REFUND = 3;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'value', 'description', 'type', 'created_at',
    ];
}
