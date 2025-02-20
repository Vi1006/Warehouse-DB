<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WarehouseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $name = $request->get('name');
        $address_id = $request->get('address_id');

        if ($name && $address_id){
            return new JsonResponse(
                DB::table('warehouses')->where('name', $name)->andwhere('address_id', $address_id)->firstOrFail(),
                Response::HTTP_OK
            );

        } else if ($address_id){
            return new JsonResponse(
                DB::table('warehouses')->where('address_id', $address_id)->firstOrFail(),
            );
        }

        return new JsonResponse(
            Warehouse::all(),
            Response::HTTP_OK
        );
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            DB::table('warehouses')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }



}

