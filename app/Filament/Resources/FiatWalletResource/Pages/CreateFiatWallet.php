<?php

namespace App\Filament\Resources\FiatWalletResource\Pages;

use App\Filament\Resources\FiatWalletResource;
use App\Models\Currency;
use App\Models\PaymentMode;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFiatWallet extends CreateRecord
{
    protected static string $resource = FiatWalletResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('currency_id')
                    ->label('Currency')
                    ->options(Currency::all()->pluck('name_with_symbol', 'id')),
                TextInput::make('amount')
                    ->numeric(),
                Select::make('type_of_user')
                    ->options([
                        'internal' => 'Internal',
                        'external' => 'External',
                        'client' => 'Client',
                    ])
                    ->default('internal'),
                Select::make('user')
                    ->options(User::pluck('name', 'id')->toArray())
                    ->default(fn() => Auth::id()),
                Select::make('payment_mode')
                    ->options(PaymentMode::pluck('name', 'id')->toArray()),
                Select::make('paid_currency')
                    ->options(Currency::pluck('name', 'id')->toArray()),
                TextInput::make('paid_amount')
                    ->numeric(),
                Textarea::make('note')
                    ->columnSpanFull(),
                Toggle::make('status')
                    ->inline(true)
                    ->default(true),
            ]);
    }
}
