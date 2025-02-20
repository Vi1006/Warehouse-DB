<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'addresses';

    public function city(): belongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'street' => $this->street,
            'city_name' => $this->city->name,
//            'clients' => $this->clients()->get()->toArray(),
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }
}
