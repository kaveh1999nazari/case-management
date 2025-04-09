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
    public function create(array $data): \App\Models\Order
    {
        $totalPrice = 0;
        $orderItems = [];

        foreach ($data['items'] as $item) {
            $productPrice = ProductPrice::query()
                ->where('product_id', $item['product_id'])
                ->latest('id')
                ->first();

            $itemTotalPrice = $productPrice->price * $item['quantity'];
            $totalPrice += $itemTotalPrice;

            $orderItems[] = [
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
