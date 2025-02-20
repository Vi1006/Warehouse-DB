<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            Inventory::all(),
            Response::HTTP_OK
        );
    }

    public function getById(int $id): JsonResponse{
        return new JsonResponse(
            DB::table('inventories')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();

        foreach (['name','description'] as $key) {
            if (!isset($requestData[$key])) {
                throw new \Exception(\sprintf("Field %s is required.", $key));
            }
        }

        if (Inventory::find($requestData['name'])) {
            throw new \Exception('Inventory already existing');
        }

        $inventory = new Inventory();
        $inventory->name = $requestData['name'];
        $inventory->description = $requestData['description'];
        $inventory->save();

        return new JsonResponse(
            $inventory,
            Response::HTTP_CREATED
        );
    }

}
