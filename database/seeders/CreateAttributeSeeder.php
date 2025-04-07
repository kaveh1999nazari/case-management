<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'رنگ',
            'متریال',
            'سایز',
            'طرح',
            'بافت',
            'زمینه',
        ];

        foreach ($attributes as $title) {
            Attribute::query()
                ->create([
                    'title' => $title
                ]);
        }
    }
}
