<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
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
use Morilog\Jalali\Jalalian;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('orderItems')
                    ->label('لیست سفارش')
                    ->relationship('orderItems')
                    ->schema([
                        Select::make('product_id')
                            ->label('محصول')
                            ->relationship('product', 'name')
                            ->disabled(),

                        TextInput::make('quantity')
                            ->label('تعداد')
                            ->numeric()
                            ->disabled(),

                        TextInput::make('total_price')
                            ->label('قیمت کل محصول')
                            ->disabled()
                            ->formatStateUsing(fn ($state) => number_format($state) . ' ریال'),

                        KeyValue::make('custom_image')
                            ->label('تصاویر سفارشی کاربر')
                            ->keyLabel('نوع')
                            ->valueLabel('آدرس تصویر')
                            ->disableAddingRows()
                            ->disableEditingKeys()
                            ->disabled(),
                    ])
                    ->columns(2)
                    ->disableItemCreation()
                    ->disableItemDeletion()
                    ->columnSpanFull()
                    ->disabled(),

                TextInput::make('final_price')
                    ->label('قیمت نهایی')
                    ->disabled()
                    ->formatStateUsing(function ($state) {
                        return number_format($state);
                    })
                    ->formatStateUsing(fn ($state) => number_format($state) . ' ریال'),
                Select::make('order_status')
                    ->label('وضعیت سفارش')
                    ->options([
                        'ثبت سفارش' => 'ثبت سفارش',
                        'در حال آماده سازی' => 'در حال آماده سازی',
                        'ارسال شده' => 'ارسال شده',
                        'لغو سفارش' => 'لغو سفارش',
                        'اتمام' => 'اتمام',
                    ])
                    ->required(),

                TextInput::make('created_at')
                    ->label('زمان سفارش')
                    ->disabled()
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';

                        $tehranTime = Carbon::parse($state)->setTimezone('Asia/Tehran');
                        return Jalalian::fromDateTime($tehranTime)->format('Y/m/d H:i:s');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('شناسه سفارش')->searchable(),
                TextColumn::make('order_status')->label('وضعیت سفارش')->searchable()
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
            'index' => Pages\ListOrders::route('/'),
//            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
