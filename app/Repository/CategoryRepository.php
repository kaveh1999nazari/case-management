<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function create(array $data): Category
    {
        return Category::query()
            ->create($data);
    }

    public function list(): Collection
    {
        return Category::query()
            ->get();
    }
}
