<?php

namespace App\Http\Resources;

use App\Models\Refund;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
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
 * @property-read Refund|null $refund
 * @property-read User $user
 *
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user_id", type="integer"),
 *     @OA\Property(property="value", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="type", type="integer"),
 *     @OA\Property(property="updated_at", type="string"),
 *     @OA\Property(property="created_at", type="string"),
 * )
 */
class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'value' => $this->value,
            'description' => $this->description,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
