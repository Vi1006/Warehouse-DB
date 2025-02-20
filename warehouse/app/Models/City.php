<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'cities';

    public function addresses(): hasMany
    {
        return $this->hasMany(Address::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'addresses' => $this->addresses,
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }
}
