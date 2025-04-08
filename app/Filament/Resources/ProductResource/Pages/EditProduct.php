<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

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
            }
        }
    }
}
