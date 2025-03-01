<?php

namespace App\Service;

use App\Repository\ShopRepository;

class ShopService
{
    public function __construct(
        private readonly ShopRepository $shopRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->shopRepository->create($data);
    }
}
