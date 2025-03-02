<?php

namespace App\Repository;

use App\Models\ShopToken;

class ShopTokenRepository
{
    public function create(array $data)
    {
        return ShopToken::query()
            ->create($data);
    }
}
