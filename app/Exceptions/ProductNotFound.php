<?php

namespace App\Exceptions;

use Exception;

class ProductNotFound extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'محصول مورد نظر یافت نشد'
        ], 406);
    }
}
