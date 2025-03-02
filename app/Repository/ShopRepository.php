<?php

namespace App\Repository;

use App\Models\Shop;

class ShopRepository
{
    public function create(array $data): Shop
    {
        return Shop::query()
            ->create($data);
    }

    public function get(string $userName, string $password)
    {
        return Shop::query()
            ->where('user_name', $userName)
            ->first();
    }
}
