<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Shop extends Model implements JWTSubject
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'user_name',
        'password',
        'mobile',
        'web_address'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
