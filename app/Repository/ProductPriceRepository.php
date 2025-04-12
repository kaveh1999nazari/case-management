<?php

namespace App\Repository;

use App\Models\ProductPrice;

class ProductPriceRepository
{
    public function getPriceByProductId(int $productId)
    {
        return ProductPrice::query()
            ->where('product_id', $productId)
            ->latest('id')
            ->first();
    }
}
