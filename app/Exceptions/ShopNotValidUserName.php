<?php

namespace App\Exceptions;

use Exception;

class ShopNotValidUserName extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'نام کاربری وارد شده اشتباه است'
        ], 406);
    }
}
