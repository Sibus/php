<?php

namespace App\Models;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property float $balance Баланс
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ProfileFactory factory(...$parameters)
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @method static Builder|Profile whereBalance($value)
 * @method static Builder|Profile whereCreatedAt($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile whereUpdatedAt($value)
 * @method static Builder|Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'balance',
    ];

    public function canAfford($value): bool
    {
        return bccomp(bcadd($this->balance, $value), 0) >= 0;
    }

    public function cannotAfford($value): bool
    {
        return !$this->canAfford($value);
    }

    public function addBalance($value): void
    {
        $this->balance = bcadd($this->balance, $value);
    }
}
