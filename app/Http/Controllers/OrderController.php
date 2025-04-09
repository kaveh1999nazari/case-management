<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Service\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
    )
    {
    }

    public function create(OrderCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->orderService->create($request->validated());

        return response()->json([
            'message' => 'سفارش با موفقیت ثبت شد'],
            201);
    }
}
