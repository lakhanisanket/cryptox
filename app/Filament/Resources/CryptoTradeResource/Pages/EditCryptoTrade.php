<?php

namespace App\Filament\Resources\CryptoTradeResource\Pages;

use App\Filament\Resources\CryptoTradeResource;
use App\Models\CryptoCurrency;
use App\Models\Currency;
use App\Models\FiatWallet;
use App\Models\PaymentMode;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCryptoTrade extends EditRecord
{
    protected static string $resource = CryptoTradeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->options([
                        'buy' => 'Buy',
                        'sell' => 'Sell',
                    ]),
                Select::make('user')
                    ->options(User::pluck('name', 'id')->toArray()),
                Select::make('currency')
                    ->options(Currency::pluck('name', 'id')->toArray()),
                TextInput::make('currency_value')
                    ->numeric(),
                Select::make('crypto_currency')
                    ->options(CryptoCurrency::pluck('name', 'id')->toArray()),
                TextInput::make('crypto_currency_value')
                    ->numeric(),
                Select::make('payment_mode')
                    ->options(PaymentMode::pluck('name', 'id')->toArray()),
                Select::make('fiat_wallet')
                    ->options(FiatWallet::pluck('user_id', 'id')->toArray()),
                SpatieMediaLibraryFileUpload::make('crypto_trade_documents')
                    ->label('Documents')
                    ->collection('crypto_trade_documents')
                    ->image()
                    ->columnSpanFull(),
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
