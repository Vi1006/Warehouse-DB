<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\InventoryOrder;
use App\Models\InventoryWarehouse;
use App\Models\Order;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryOrderFactory extends Factory
{
    protected $model = InventoryOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
