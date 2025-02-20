<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $name = $request->get('name');

        if ($name){
            return new JsonResponse(
                DB::table('cities')->where('name', $name)->firstOrFail(),
                Response::HTTP_OK
            );
        }

        return new JsonResponse(
            City::all(),
            Response::HTTP_OK
        );
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            DB::table('cities')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();

        if (!isset($requestData["name"])) {
           throw new \Exception("Name %s is required.");
        }

        if (City::find($requestData['name'])) {
            throw new \Exception('City name already existing');
        }

        $city = new City();
        $city->name = $requestData['name'];
        $city->save();

        return new JsonResponse(
            $city,
            Response::HTTP_CREATED
        );
    }

    public function edit(int $id, Request $request): JsonResponse
    {
        if (!$city = City::find($id)) {
            throw new \Exception('City not found');
        }

        $allowedForUpdate = ['name'];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if (!in_array($key, $allowedForUpdate)) {
                throw new \Exception(\sprintf("Allowed field for update is name"));
            }
        }

        $city->name = $requestData['name'] ?? $city->name;
        $city->save();

        return new JsonResponse(
            $city,
            Response::HTTP_CREATED
        );
    }

    public function deleteById(int $id): JsonResponse
    {
        $city = City::find($id);

        if (!$city) {
            throw new \Exception('City not found');
        }

        $deleted = DB::table('cities')->where('id', $id)->delete();

        return new JsonResponse(
            sprintf('%s city has been deleted', $city->name),
        );
    }

}
