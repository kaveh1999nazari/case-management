<?php

namespace App\Repository;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function create(array $data, string $finalPrice)
    {
        return Order::query()
            ->create([
                'user_id' => Auth::id(),
                'address_id' => $data['address_id'],
                'final_price' => $finalPrice,
                'order_status' => OrderStatusEnum::NOT_PAID,
            ]);
    }
}
