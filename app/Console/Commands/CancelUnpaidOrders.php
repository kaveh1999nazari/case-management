<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:unpaid-orders';
    protected $description = 'لغو سفارش‌های پرداخت‌نشده و بازگرداندن موجودی';



    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOrders = Order::query()
            ->where('order_status', 'پرداخت نشده')
            ->where('created_at', '<=', now()->subMinutes(15))
            ->get();

        foreach($expiredOrders as $order) {
            foreach ($order->orderItems as $item) {
                $item->product->stock_quantity += $item->quantity;
                $item->product->save();
            }

            $order->update([
                'order_status' => 'لغو سفارش'
            ]);

            $this->info("order #{$order->id} has canceled.");
        }
    }
}
