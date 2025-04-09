<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'custom_image',
        'total_price'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
