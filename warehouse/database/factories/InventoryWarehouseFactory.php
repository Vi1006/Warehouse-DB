<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\InventoryWarehouse;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryWarehouseFactory extends Factory
{
    protected $model = InventoryWarehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inventory_id' => Inventory::pluck('id')->random(),
            'warehouse_id' => Warehouse::pluck('id')->random(),
        ];
    }
}
