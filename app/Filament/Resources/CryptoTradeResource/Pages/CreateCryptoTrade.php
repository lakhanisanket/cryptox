<?php

namespace App\Filament\Resources\CryptoTradeResource\Pages;

use App\Filament\Resources\CryptoTradeResource;
use App\Models\CryptoCurrency;
use App\Models\Currency;
use App\Models\FiatWallet;
use App\Models\PaymentMode;
use App\Models\Platform;
use App\Models\PlatformAccount;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCryptoTrade extends CreateRecord
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
                    ->options(User::pluck('name', 'id')->toArray())
                    ->default(fn() => Auth::id()),
                Select::make('platform_id')
                    ->label('Platform')
                    ->options(Platform::pluck('name', 'id')->toArray())
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('platform_accounts_id', null)),
                Select::make('platform_accounts_id')
                    ->label('Platform Account')
                    ->options(function (callable $get) {
                        $platformId = $get('platform_id');
                        if ($platformId) {
                            return PlatformAccount::where('platform_id', $platformId)->pluck('username', 'id');
                        }
                        return [];
                    })
                    ->reactive(),
                Select::make('currency_id')
                    ->label('Currency')
                    ->options(Currency::all()->pluck('name_with_symbol', 'id')),
                TextInput::make('currency_value')
                    ->numeric(),
                Select::make('crypto_currency_id')
                    ->label('Currency Currency')
                    ->options(CryptoCurrency::pluck('name', 'id')->toArray()),
                TextInput::make('crypto_currency_value')
                    ->numeric(),
                Select::make('payment_mode_id')
                    ->label('Payment Mode')
                    ->options(PaymentMode::all()->pluck('name_with_icon', 'id')),
                Select::make('fiat_wallet_id')
                    ->label('Fiat Wallet')
                    ->options(FiatWallet::pluck('user_id', 'id')->toArray()),
                SpatieMediaLibraryFileUpload::make('crypto_trade_documents')
                    ->label('Documents')
                    ->multiple()
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
}
