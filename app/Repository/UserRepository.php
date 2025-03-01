<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(string $mobile): User
    {
        return User::query()
            ->create([
                'mobile' => $mobile
            ]);
    }

    public function getByMobile(string $mobile): User|null
    {
        return User::query()
            ->where('mobile', $mobile)
            ->first();
    }
}
