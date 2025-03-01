<?php

namespace App\Exceptions;

use Exception;

class UserNotFound extends Exception
{
    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'کاربر مورد نظر یافت نشد',
            404
        ]);
    }
}
