<?php

namespace App\Service;

use App\Exceptions\ProductNotFound;
use App\Exceptions\ProductOutOfStock;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository,
        private readonly ProductRepository $productRepository,
        private readonly ProductService $productService,
        private readonly ProductPriceRepository $productPriceRepository,
    )
    {
    }

    /**
     * @throws ProductOutOfStock
     * @throws ProductNotFound
     */
    public function create(array $data): \App\Models\Order
    {
        $totalPrice = 0;
        $orderItems = [];

        foreach ($data['items'] as $item) {

            $product = $this->productRepository->getById($item['product_id']);

            $productPrice = $this->productPriceRepository->getPriceByProductId($item['product_id']);

            if (! $product || ! $productPrice) {
                throw new ProductNotFound();
            }

            $itemTotalPrice = $productPrice->price * $item['quantity'];
            $totalPrice += $itemTotalPrice;

            $this->productService->updateStock($item['product_id'], $item['quantity']);

            $orderItems[] = [
                'shop_id' => $product->shop_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'custom_image' => $item['custom_image'] ?? [],
                'total_price' => $itemTotalPrice,
            ];
        }

        $order = $this->orderRepository->create($data, $totalPrice);

        foreach ($orderItems as $item) {
            $this->orderItemRepository->create($item, $order->id);
        }

        return $order;
    }
}
