<?php

namespace App\Exceptions;

use Exception;

class ShopNotValidPassword extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'رمز وارد شده اشتباه است'
        ], 406);
    }
}
