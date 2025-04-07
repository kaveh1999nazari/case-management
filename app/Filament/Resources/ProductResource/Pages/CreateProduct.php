<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['shop_id'] = Auth::guard('shop')->id();
        return $data;
    }

    protected function afterCreate(): void
    {
        $product = $this->record;

        // ذخیره product_detail
        $product->productDetail()->create($this->form->getState()['product_detail']);

        // ذخیره product_attributes
        foreach ($this->form->getState()['product_attributes'] as $attr) {
            $productAttribute = $product->productAttributes()->create($attr);

            // وصل کردن قیمت‌ها به ویژگی
            $product->productPrices()->create([
                'price' => $this->form->getState()['product_prices'],
                'product_attribute_id' => $productAttribute->id,
            ]);
        }
    }

}
