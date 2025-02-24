<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'name',
        'user_name',
        'password',
        'mobile',
        'web_address'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}
