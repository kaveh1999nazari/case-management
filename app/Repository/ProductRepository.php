<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    public function totalPrice(array $productIds)
    {
        return  Product::query()
            ->whereIn('id', $productIds)
            ->sum('price');
    }
}
