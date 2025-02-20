<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model implements \JsonSerializable
{
    use HasFactory;

    protected $table = 'clients';

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->created_at->format(\DATE_ATOM),
            'updated_at' => $this->created_at->format(\DATE_ATOM),
        ];
    }
}
