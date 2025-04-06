<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Http\Responses\Auth\LoginResponse;


class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_name')
                    ->label('نام کاربری')
                    ->required()
                    ->autofocus(),

                TextInput::make('password')
                    ->label('رمز عبور')
                    ->required()
                    ->autocomplete('current-password'),
            ]);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('درخواست بیش از حد مجاز')
                ->body('لطفاً چند لحظه صبر کنید و دوباره تلاش کنید.')
                ->danger()
                ->persistent()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $shop = \App\Models\Shop::query()
            ->where('user_name', $data['user_name'])
            ->first();

        if (! $shop || ! Hash::check($data['password'], $shop->password)) {
            $this->addError('user_name', 'نام کاربری یا رمز عبور اشتباه است');
            return null;
        }

        Auth::guard('shop')->login($shop);

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
