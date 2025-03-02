<?php

namespace App\Service;

use App\Exceptions\ShopNotValidPassword;
use App\Exceptions\ShopNotValidUserName;
use App\Repository\ShopRepository;
use App\Repository\ShopTokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ShopService
{
    public function __construct(
        private readonly ShopRepository $shopRepository,
        private readonly ShopTokenRepository $shopTokenRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->shopRepository->create($data);
    }

    public function login(array $data)
    {

        $shop = $this->shopRepository->get($data['user_name'], $data['password']);

        if (!$shop || !Hash::check($data['password'], $shop->password)) {
            throw new ShopNotValidPassword();
        }

        if ($shop && $shop->getAttributes()['user_name'] === $data['user_name']) {
            $token = auth('shop')->login($shop);

            $this->shopTokenRepository->create([
                'shop_id' => $shop->id,
                'token' => $token
            ]);
        } else {
            throw new ShopNotValidUserName();
        }

        return $this->respondWithToken($token)->getOriginalContent();
    }

    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('shop')->factory()->getTTL() * 60
        ]);
    }
}
