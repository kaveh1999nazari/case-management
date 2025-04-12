<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    public function getById(int $productId)
    {
        return  Product::query()
            ->find($productId);
    }
}
