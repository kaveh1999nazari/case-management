<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserConfirmOtpRequest;
use App\Http\Requests\UserRequestOtpRequest;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function requestOtp(UserRequestOtpRequest $request): JsonResponse
    {
        $code = $this->userService->requestOtp($request->validated('mobile'));

        return response()->json([
            'code' => $code
        ]);
    }

    public function confirmOtp(UserConfirmOtpRequest $request): JsonResponse
    {
        $token = $this->userService->confirmOtp($request->validated());

        return response()->json([
            'token' => $token
        ]);
    }
}
