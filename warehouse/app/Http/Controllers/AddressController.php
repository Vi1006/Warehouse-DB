<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $city_name = $request->get('city_name');
        $city_id = $request->get('city_id');
        $street = $request->get('street');

        if ($city_name){
            return new JsonResponse(
                DB::table('addresses')->join('cities', 'cities.id', '=', 'addresses.city_id')
                    ->where('cities.name', $city_name)->firstOrFail(),
                Response::HTTP_OK
            );
        } else if ($city_id) {
            return new JsonResponse(
                DB::table('addresses')->where(['city_id' => $city_id])->firstOrFail(),
                Response::HTTP_OK
            );
        } else if ($street) {
            return new JsonResponse(
                DB::table('addresses')->where(['street' => $street])->firstOrFail(),
            );
        }

        return new JsonResponse(
            Address::all(),
            Response::HTTP_OK
        );
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            DB::table('addresses')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();

        if (!isset($requestData["street"])) {
            throw new \Exception("Street %s is required.");
        }

//        if (Address::find($requestData['street']) && Address::find($requestData['city_id'])) {
//            throw new \Exception('Address already existing');
//        }

        $address = new Address();
        $address->street = $requestData['street'];
        $address->city_id = $requestData['city_id'];
        $address->save();

        return new JsonResponse(
            $address,
            Response::HTTP_CREATED
        );
    }

    public function edit(int $id, Request $request): JsonResponse
    {
        if (!$address = Address::find($id)) {
            throw new \Exception('Address not found');
        }

        $allowedForUpdate = ['street', 'city_id'];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if (!in_array($key, $allowedForUpdate)) {
                throw new \Exception(\sprintf("Allowed fields for update are: street and city_id"));
            }
        }

        if (isset($requestData['city_id'])
            && empty(DB::table('cities')->where('id', $requestData['city_id'])->first())
        ) {
            throw new \Exception('City id not found or not existing');
        }

        $address->city_id = $requestData['city_id'] ?? $address->city_id;
        $address->street = $requestData['street'] ?? $address->street;
        $address->save();

        return new JsonResponse(
            $address,
            Response::HTTP_CREATED
        );
    }

    public function deleteById(int $id): JsonResponse
    {
        $address = Address::find($id);

        if (!$address) {
            throw new \Exception('Address not found');
        }

        $deleted = DB::table('addresses')->where('id', $id)->delete();

        return new JsonResponse(
            sprintf('%s street has been deleted', $address->street),
        );
    }
}
