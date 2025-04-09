<?php

namespace App\Service;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository,

    )
    {
    }
    public function create(array $data): void
    {
        $totalPrice = 0;
        $orderItems = [];

        foreach ($data['items'] as $item) {
            $product = ProductPrice::query()
                ->find($item['product_id']);
            $itemTotalPrice = $product->price * $item['quantity'];

            $totalPrice += $itemTotalPrice;

            $orderItems[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'custom_image' => $item['custom_image'],
                'total_price' => $itemTotalPrice,
            ];
        }

        $order = $this->orderRepository->create($data, $totalPrice);

        foreach ($orderItems as $orderItem) {
            $this->orderItemRepository->create($orderItem, $order->id);
        }
    }
}
