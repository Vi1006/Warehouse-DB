<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'order_statuses';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }
}
