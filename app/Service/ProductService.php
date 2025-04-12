<?php

namespace App\Service;

use App\Exceptions\ProductNotFound;
use App\Exceptions\ProductOutOfStock;
use App\Repository\ProductRepository;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    )
    {
    }

    public function updateStock(int $productId, int $quantity)
    {
        $product = $this->productRepository->getById($productId);

        if (! $product) {
            throw new ProductNotFound();
        }

        if ($quantity > $product->stock_quantity) {
            throw new ProductOutOfStock();
        }

        $newQuantity = $product->stock_quantity - $quantity;

        return $product->update([
            'stock_quantity' => $newQuantity
        ]);
    }
}
