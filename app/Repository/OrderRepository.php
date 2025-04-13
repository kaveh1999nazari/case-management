<?php

namespace App\Repository;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;

class OrderRepository
{
    public function create(array $data, string $finalPrice, Authenticatable $user)
    {
        return Order::query()
            ->create([
                'user_id' => $user->id,
                'address_id' => $data['address_id'],
                'final_price' => $finalPrice,
                'order_status' => OrderStatusEnum::NOT_PAID,
            ]);
    }
}
