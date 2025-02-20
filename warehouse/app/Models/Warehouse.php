<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'warehouses';

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function inventories(): BelongsToMany
    {
       return $this->belongsToMany(Inventory::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'address_id' => $this->address_id,
            'name' => $this->name,
            'inventories' => $this->inventories()->get()->toArray(),
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }

}
