<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserPasswordIncorrect extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'رمز وارد شده اشتباه است',
            406
        ]);
    }
}
