<?php

namespace App\Exceptions;

use Exception;

class ProductOutOfStock extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'تعداد درخواست شما بیشتر از موجودی انبار است'
        ], 406);
    }
}
