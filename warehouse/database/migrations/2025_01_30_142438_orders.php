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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('client_id');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('order_status_id')
                ->references('id')->on('order_statuses')
                ->onUpdate('cascade')->onDelete('restrict');
        });

//        Schema::table('orders', function (Blueprint $table) {
//            $table->foreign('inventory_id')
//                ->references('id')->on('inventories')
//                ->onUpdate('cascade')->onDelete('restrict');
//        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['order_status_id']);
        });

//        Schema::table('orders', function (Blueprint $table) {
//            $table->dropForeign(['inventory_id']);
//        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::dropIfExists('orders');
    }
};
