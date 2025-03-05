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
            'Color',
            'Material',
            'Pattern',
            'Size',
            'Design',
            'Capacity',
            'Texture',
            'Theme',
        ];

        foreach ($attributes as $title) {
            Attribute::query()
                ->create([
                    'title' => $title
                ]);
        }
    }
}
