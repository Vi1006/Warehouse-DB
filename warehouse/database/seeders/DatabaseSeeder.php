<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CitySeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(InventoryWarehouseSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(InventoryOrderSeeder::class);
    }
}
