<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });

        Schema::table('inventory_order', function (Blueprint $table) {
            $table->foreign('inventory_id')
                ->references('id')->on('inventories')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('inventory_order', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_order', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
        });

        Schema::table('inventory_order', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('inventory_order');
    }
};
