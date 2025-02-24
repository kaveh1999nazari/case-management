<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'قاب موبایل',
            'لیوان',
            'لباس',
            'دفتر',
            'لبتاب'
        ];
        foreach ($names as $name) {
            Category::query()
                ->create([
                    'name' => $name
                ]);
        }
    }
}
