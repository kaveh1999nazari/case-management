<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $product = $this->record;

        $data['product_detail'] = $product->productDetail ? $product->productDetail->toArray() : [];

        $data['product_attributes'] = $product->productAttributes->map(function ($attr) {
            return [
                'attribute_id' => $attr->attribute_id,
                'attribute_value_id' => $attr->attribute_value_id,
            ];
        })->toArray();

        $firstPrice = $product->productPrices->first();
        $data['product_prices'] = $firstPrice ? $firstPrice->price : null;

        $data['product_images'] = $product->productImages->map(function ($img) {
            return ['url' => $img->url];
        })->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['shop_id'] = Auth::guard('shop')->id();
        return $data;
    }

    protected function afterSave(): void
    {
        $product = $this->record;

        $product->productDetail()->update($this->form->getState()['product_detail']);

        if (isset($this->form->getState()['product_attributes'])) {
            foreach ($this->form->getState()['product_attributes'] as $attr) {
                $productAttribute = $product->productAttributes()
                    ->where('attribute_id', $attr['attribute_id'])
                    ->first();

                if ($productAttribute) {
                    if ($productAttribute->attribute_value_id !== $attr['attribute_value_id']) {
                        $productAttribute->update([
                            'attribute_value_id' => $attr['attribute_value_id']
                        ]);
                    }
                } else {
                    $productAttribute = $product->productAttributes()->create([
                        'attribute_id' => $attr['attribute_id'],
                        'attribute_value_id' => $attr['attribute_value_id']
                    ]);
                }

                $product->productPrices()->updateOrCreate(
                    ['product_attribute_id' => $productAttribute->id],
                    ['price' => $this->form->getState()['product_prices']]
                );

                $productImages = $this->form->getState()['product_images'];

                foreach ($productImages as $img) {
                    if (isset($img['url'])) {
                        $product->productImages()->updateOrCreate(['url' => $img['url']]);
                    }
                }
            }
        }
    }
}
