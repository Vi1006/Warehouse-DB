<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    const ORDER_STATUS = [
        'ACTIVE' => 1,
        'COMPLETED' => 2,
        'CANCELLED' => 3,
    ];

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            DB::table('orders')->where('id', $id)->firstOrFail(),
            Response::HTTP_OK
        );
    }

    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            Order::all(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();

        foreach (['status', 'client_id', 'quantity'] as $key) {
           if (!isset($requestData[$key])) {
               throw new \Exception(\sprintf("Field %s is required.", $key));
           }
        }

        if ((int)$requestData['status'] !== self::ORDER_STATUS['ACTIVE']) {
            throw new \Exception('On create order status must be active always');
        }

        if (empty(Client::find($requestData['client_id']))) {
            throw new \Exception('Client id not found or not existing');
        }

        if ((int)$requestData['quantity'] <= 0) {
            throw new \Exception('Quantity must be greater than 0');
        } elseif ((int)$requestData['quantity'] >= 100) {
            throw new \Exception('Quantity must be less than 100');
        } elseif (!is_int((int)$requestData['quantity'])) {
            throw new \Exception('Quantity must be integer (whole number)');
        }

        $order = new Order();
        $order->order_status_id = $requestData['status'];
        $order->client_id = $requestData['client_id'];
        $order->quantity = $requestData['quantity'];
        $order->save();

        return new JsonResponse(
            $order,
            Response::HTTP_CREATED
        );
    }

    public function edit(int $id, Request $request): JsonResponse
    {
        if (!$order = Order::find($id)) {
            throw new \Exception('Order not found');
        }

        $allowedForUpdate = ['status', 'client_id', 'quantity'];
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if (!in_array($key, $allowedForUpdate)) {
                throw new \Exception(\sprintf("Allowed fields for update are: status, client_id, quantity"));
            }
        }

        if (isset($requestData['status']) &&
            !\in_array((int)$requestData['status'], self::ORDER_STATUS)
        ) {
            throw new \Exception('Status could be ACTIVE, COMPLETED or CANCELED (1,2,3)');
        }

        if (isset($requestData['client_id'])
            && empty(DB::table('clients')->where('id', $requestData['client_id'])->first())
        ) {
            throw new \Exception('Client id not found or not existing');
        }

        if (isset($requestData['quantity'])) {
            if ((int)$requestData['quantity'] <= 0) {
                throw new \Exception('Quantity must be greater than 0');
            } elseif ((int)$requestData['quantity'] >= 100) {
                throw new \Exception('Quantity must be less than 100');
            } elseif (!is_int((int)$requestData['quantity'])) {
                throw new \Exception('Quantity must be integer (whole number)');
            }
        }

        $order->order_status_id = $requestData['status'] ?? $order->order_status_id;
        $order->client_id = $requestData['client_id'] ?? $order->client_id;
        $order->quantity = $requestData['quantity'] ?? $order->quantity;
        $order->save();

        return new JsonResponse(
            $order,
            Response::HTTP_CREATED
        );
    }
}
