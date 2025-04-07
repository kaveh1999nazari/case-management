<?php

namespace App\Service;

use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    )
    {
    }

    public function create(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }
}
