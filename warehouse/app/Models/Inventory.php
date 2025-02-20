<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'inventories';

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->BelongsToMany(Order::class);
    }
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'warehouses' => $this->warehouses()->get()->toArray(),
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->updated_at->format(\DATE_ATOM),
        ];
    }
}
