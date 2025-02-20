<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            Client::all(),
            Response::HTTP_OK
        );
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            DB::table('clients')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();

        foreach (['address_id','first_name', 'last_name', 'email', 'password'] as $key) {
            if (!isset($requestData[$key])) {
                throw new \Exception(\sprintf("Field %s is required.", $key));
            }
        }

        if (Client::find($requestData['email'])) {
            throw new \Exception('Email address already existing');
        }

        $client = new Client();
        $client->address_id = $requestData['address_id'];
        $client->first_name = $requestData['first_name'];
        $client->last_name = $requestData['last_name'];
        $client->email = $requestData['email'];
        $client->password = $requestData['password'];
        $client->save();

        return new JsonResponse(
            $client,
            Response::HTTP_CREATED
        );
    }

    public function edit(int $id, Request $request): JsonResponse
    {
        if (!$client = Client::find($id)) {
            throw new \Exception('Client not found');
        }

        $allowedForUpdate = ['first_name', 'last_name','address_id', 'password'];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if (!in_array($key, $allowedForUpdate)) {
                throw new \Exception(\sprintf("Allowed fields for update are: first_name, last_name, address_id and password"));
            }
        }

        $client->first_name = $requestData['first_name'] ?? $client->first_name;
        $client->last_name = $requestData['last_name'] ?? $client->last_name;
        $client->address_id = $requestData['address_id'] ?? $client->address_id;
        $client->password = $requestData['password'] ?? $client->password;
        $client->save();

        return new JsonResponse(
            $client,
            Response::HTTP_CREATED
        );
    }


}
