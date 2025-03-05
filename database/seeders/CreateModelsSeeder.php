<?php

namespace Database\Seeders;

use App\Models\Models;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class CreateModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::query()
            ->get();

        $models = [
            // Apple
            'Apple' => ['iPhone 12', 'iPhone 13', 'iPhone 14'],
            // Samsung
            'Samsung' => ['Galaxy S21', 'Galaxy S22', 'Galaxy Note 20'],
            // Xiaomi
            'Xiaomi' => ['Mi 11', 'Mi 12', 'Redmi Note 10'],
            // Huawei
            'Huawei' => ['P40', 'Mate 40', 'Nova 7'],
            // OnePlus
            'OnePlus' => ['OnePlus 8', 'OnePlus 9', 'OnePlus 10'],
            // Add other brands and their models similarly...
        ];

        foreach ($models as $brandName => $modelNames) {
            $brand = $brands->firstWhere('name', $brandName);

            foreach ($modelNames as $modelName) {
                Models::query()
                ->create([
                    'brand_id' => $brand->id,
                    'name' => $modelName,
                ]);
            }
        }
    }
}
