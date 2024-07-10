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
use Filament\Resources\Pages\EditRecord;

class EditFiatWallet extends EditRecord
{
    protected static string $resource = FiatWalletResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('currency_id')
                    ->options(Currency::pluck('name', 'id')->toArray())
                    ->relationship('currency', 'name'),
                TextInput::make('amount')
                    ->numeric(),
                Select::make('type_of_user')
                    ->options([
                        'internal' => 'Internal',
                        'external' => 'External',
                        'client' => 'Client',
                    ]),
                Select::make('user')
                    ->options(User::pluck('name', 'id')->toArray())
                    ->relationship('user', 'name'),
                Select::make('payment_mode_id')
                    ->options(PaymentMode::pluck('name', 'id')->toArray())
                    ->relationship('paymentMode', 'name'),
                Select::make('paid_currency_id')
                    ->options(Currency::pluck('name', 'id')->toArray())
                    ->relationship('currency', 'name'),
                TextInput::make('paid_amount')
                    ->numeric(),
                Textarea::make('note')
                    ->columnSpanFull(),
                Toggle::make('status')
                    ->inline(true)
                    ->default(true),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
