<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Models extends Model
{
    protected $table = 'models';

    protected $fillable = [
        'brand_id',
        'name'
    ];

    public function brands(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
