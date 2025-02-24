<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'address',
        'postal_code',
        'recipient_name',
        'mobile'
    ];
}
