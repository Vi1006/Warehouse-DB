<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\InventoryWarehouse;
use App\Models\OrderStatus;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class OrderStatusFactory extends Factory
{
    protected $model = OrderStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'status' => $this->faker->randomElement(['CANCELED', 'ACTIVE', 'COMPLETED']),
        ];
    }
}
