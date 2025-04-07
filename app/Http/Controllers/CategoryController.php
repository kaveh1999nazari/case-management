<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    )
    {
    }

    public function create(CategoryCreateRequest $request): Category
    {
        return $this->categoryService->create($request->validated());
    }
}
