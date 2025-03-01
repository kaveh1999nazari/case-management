<?php

namespace App\Service;

use App\Exceptions\UserNotFound;
use App\Exceptions\UserPasswordIncorrect;
use App\Repository\UserRepository;
use App\Repository\UserTokenRepository;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserTokenRepository $userTokenRepository
    )
    {
    }

    //TODO add message notification feature in future
    public function requestOtp(string $mobile)
    {
        $user = $this->userRepository->getByMobile($mobile);

        if (! $user) {
            $user = $this->userRepository->create($mobile);
        }

        $code = $this->userTokenRepository->create($user->id);

        return $code->code;
    }

    public function confirmOtp(array $data)
    {
        $user = $this->userRepository->getByMobile($data['mobile']);

        if (! $user) {
            throw new UserNotFound();
        }

        $auth = $this->userTokenRepository->get($user->id);

        if ($auth
            && $auth->getAttributes()['code'] === $data['code']
            && $auth->getAttributes()['code_expired_at'] > now()
        ) {
            $token = auth('api')->login($user);

            $this->userTokenRepository->update([
                'user_id' => $user->id,
                'token' => $token
            ]);
        }else {
            throw new UserPasswordIncorrect();
        }

        return $this->respondWithToken($token)->getOriginalContent();
    }

    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
