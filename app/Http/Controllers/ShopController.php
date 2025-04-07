<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopCreateRequest;
use App\Http\Requests\ShopLoginRequest;
use App\Service\ShopService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        private readonly ShopService $shopService
    )
    {
    }

    public function register(ShopCreateRequest $request): JsonResponse
    {
        $shop = $this->shopService->create($request->validated());

        return response()->json([
            'id' => $shop->id
        ]);
    }
}
