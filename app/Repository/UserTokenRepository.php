<?php

namespace App\Repository;

use App\Models\UserToken;

class UserTokenRepository
{

    public function get(int $userId): UserToken|null
    {
        return UserToken::query()
            ->where('user_id', $userId)
            ->first();
    }

    public function create(int $userId): UserToken
    {
        return UserToken::query()
            ->updateOrCreate(
                ['user_id' => $userId],
                [
                    'code' => rand(100000, 999999),
                    'code_expired_at' => now()->addMinutes(3)
                ]
            );
    }

    public function update(array $data): int
    {
        return UserToken::query()
            ->where('user_id', $data['user_id'])
            ->update([
                'token' => $data['token']
            ]);
    }

}
