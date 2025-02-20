<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_id' => Address::pluck('id')->random(),
            'name' => fake()->userName()
        ];
    }
}
