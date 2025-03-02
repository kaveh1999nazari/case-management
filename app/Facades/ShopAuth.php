<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ShopAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shop';
    }
}
