<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'orders';

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'client' => $this->client()->get(),
            'inventories' => $this->inventories()->get(),
            'order_status' => $this->status()->get(),
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }
}
