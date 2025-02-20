<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Inventory;
use App\Models\InventoryWarehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryWarehouse::factory(10)->create();
    }
}
