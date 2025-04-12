<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotFound;
use App\Exceptions\ProductOutOfStock;
use App\Http\Requests\OrderCreateRequest;
use App\Service\OrderService;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
    )
    {
    }

    /**
     * @throws ProductOutOfStock
     * @throws ProductNotFound
     */
    public function create(OrderCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $order = $this->orderService->create($request->validated());

        return response()->json([
            'message' => ['id' => $order->id],
            'status' => 201]);
    }
}
