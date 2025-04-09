<?php

namespace App\Repository;

use App\Models\OrderItem;

class OrderItemRepository
{
    public function create(array $item, int $orderId): void
    {
        OrderItem::query()
            ->create([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'custom_image' => $item['custom_image'],
                'total_price' => $item['total_price'],
            ]);
    }
}
