<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class CreateAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'رنگ' => ['Black', 'White', 'Red', 'Blue', 'Green', 'Yellow', 'Pink', 'Gray', 'Orange'],
            'متریال' => ['Plastic', 'Silicone', 'Leather', 'Metal', 'Wood'],
            'سایز' => ['Small', 'Medium', 'Large'],
            'طرح' => ['Minimalist', 'Cartoon', 'Futuristic', 'Vintage', 'Luxury'],
            'Texture' => ['Smooth', 'Matte', 'Glossy', 'Embossed'],
            'Theme' => ['Anime', 'Superhero', 'Nature', 'Gaming', 'Tech'],
        ];

        foreach ($attributes as $attributeTitle => $values) {
            $attribute = Attribute::query()
                ->where('title', $attributeTitle)
                ->first();

            if (!$attribute) {
                continue;
            }

            foreach ($values as $value) {
                AttributeValue::query()
                    ->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);
            }
        }
    }
}
