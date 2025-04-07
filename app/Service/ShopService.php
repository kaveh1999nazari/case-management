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
    )
    {
    }

    public function create(array $data)
    {
        return $this->shopRepository->create($data);
    }
}
