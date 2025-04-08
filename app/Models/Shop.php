<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model implements FilamentUser, AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'shops';

    protected $fillable = [
        'name',
        'user_name',
        'password',
        'mobile',
        'web_address'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
