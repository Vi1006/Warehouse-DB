<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryOrder;
use App\Models\Order;
use Illuminate\Database\Seeder;

class InventoryOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Order::all() as $order) {
            InventoryOrder::factory()->create([
                'inventory_id' => Inventory::pluck('id')->random(),
                'order_id' => $order->id,
            ]);
        }
    }
}
