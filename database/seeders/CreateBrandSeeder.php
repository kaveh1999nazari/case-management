<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class CreateBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // 📱 برندهای موبایل
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Xiaomi'],
            ['name' => 'Huawei'],
            ['name' => 'OnePlus'],
            ['name' => 'Google'],
            ['name' => 'Sony'],
            ['name' => 'Oppo'],
            ['name' => 'Vivo'],
            ['name' => 'Realme'],
            ['name' => 'Nokia'],
            ['name' => 'Motorola'],
            ['name' => 'LG'],
            ['name' => 'HTC'],

            // 💻 برندهای لپ‌تاپ و کامپیوتر
            ['name' => 'HP'],
            ['name' => 'Dell'],
            ['name' => 'Lenovo'],
            ['name' => 'Asus'],
            ['name' => 'Acer'],
            ['name' => 'MSI'],
            ['name' => 'Razer'],
            ['name' => 'Alienware'],
            ['name' => 'Microsoft'],

            // 🎧 برندهای لوازم جانبی (هدفون، اسپیکر و ...)
            ['name' => 'Beats'],
            ['name' => 'JBL'],
            ['name' => 'Sony'],
            ['name' => 'Logitech'],
            ['name' => 'Corsair'],
            ['name' => 'SteelSeries'],

            // 👕 برندهای لباس و پوشاک
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Puma'],
            ['name' => 'Reebok'],
            ['name' => 'Under Armour'],
            ['name' => 'New Balance'],
            ['name' => 'Zara'],
            ['name' => 'H&M'],
            ['name' => 'Levi\'s'],
            ['name' => 'Gucci'],
            ['name' => 'Versace'],
            ['name' => 'Dior'],
        ];

        foreach ($brands as $brand) {
            Brand::query()
            ->create($brand);
        }
    }
}
