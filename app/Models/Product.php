<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'shop_id',
        'name',
        'description',
        'stock_quantity'
    ];
}
