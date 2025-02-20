<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/inventories', [InventoryController::class, 'index']);
Route::get('/warehouses', [WarehouseController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);

Route::get('/addresses/{id}', [AddressController::class, 'getById']);
Route::get('/cities/{id}', [CityController::class, 'getById']);
Route::get('/clients/{id}', [ClientController::class, 'getById']);
Route::get('/inventories/{id}', [InventoryController::class, 'getById']);
Route::get('/warehouses{id}', [WarehouseController::class, 'getById']);
Route::get('/orders/{id}', [OrderController::class, 'getById']);

Route::post('/addresses', [AddressController::class, 'store']);
Route::post('/cities', [CityController::class, 'store']);
Route::post('/clients', [ClientController::class, 'store']);
ROute::post('/inventories', [InventoryController::class, 'store']);
Route::post('/orders', [OrderController::class, 'store']);

Route::put('/addresses/{id}', [AddressController::class, 'edit']);
Route::put('/cities/{id}', [CityController::class, 'edit']);
Route::put('/clients/{id}', [ClientController::class, 'edit']);
Route::put('/orders/{id}', [OrderController::class, 'edit']);

Route::delete('addresses/{id}', [AddressController::class, 'deleteById']);
Route::delete('cities/{id}', [CityController::class, 'deleteById']);

