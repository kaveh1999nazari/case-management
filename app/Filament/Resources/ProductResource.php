<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('دسته‌بندی محصول')
                    ->options(Category::all()->pluck('name', 'id')->toArray())
                    ->required(),
                Forms\Components\TextInput::make('name')->label('نام محصول')->required(),
                Select::make('product_detail.brand_id')
                    ->label('برند')
                    ->options(\App\Models\Brand::all()->pluck('name', 'id'))
                    ->reactive()
                    ->required(),
                Select::make('product_detail.model_id')
                    ->label('مدل')
                    ->options(function (callable $get) {
                        $brandId = $get('product_detail.brand_id');
                        if (!$brandId) {
                            return [];
                        }

                        return \App\Models\Models::where('brand_id', $brandId)->pluck('name', 'id')->toArray();
                    })
                    ->required(),
                Repeater::make('product_attributes')
                    ->label('ویژگی‌های محصول')
                    ->schema([
                        Select::make('attribute_id')
                            ->label('ویژگی')
                            ->options(\App\Models\Attribute::all()->pluck('title', 'id'))
                            ->required(),

                        Select::make('attribute_value_id')
                            ->label('مقدار ویژگی')
                            ->options(\App\Models\AttributeValue::all()->pluck('value', 'id'))
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2),
                Forms\Components\TextInput::make('product_prices')
                    ->label('قیمت محصول')
                    ->helperText('به ریال وارد کنید')
                    ->required(),
                Forms\Components\TextInput::make('stock_quantity')
                    ->label('موجودی انبار')
                    ->numeric()
                    ->required()
                    ->rule([
                        function ($attribute, $value, $fail) {
                            if ($value < 0) {
                                $fail('موجودی نمی‌تونه منفی باشه');
                            }
                        },
                    ]),
                Forms\Components\TextInput::make('description')
                    ->label('توضیحات')
                    ->placeholder('توضیحات محصولات خود را بنویسید')
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'min-height: 100px'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('نام محصول')->searchable(),
                TextColumn::make('stock_quantity')->label('موجودی'),
                TextColumn::make('category_id')->label('دسته‌بندی'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
