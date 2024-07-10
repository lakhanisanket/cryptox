<?php

namespace App\Filament\Resources\CryptoTradeResource\Pages;

use App\Filament\Resources\CryptoTradeResource;
use App\Models\Platform;
use App\Models\PlatformAccount;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListCryptoTrades extends ListRecords
{
    protected static string $resource = CryptoTradeResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'buy' => 'success',
                        'sell' => 'danger',
                    }),
                TextColumn::make('platformAccounts.platform_with_account'),
                TextColumn::make('currency.name'),
                TextColumn::make('currency_value'),
                TextColumn::make('cryptoCurrency.name'),
                TextColumn::make('crypto_currency_value'),
                ToggleColumn::make('status'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'buy' => 'Buy',
                        'sell' => 'Sell'
                    ]),
                SelectFilter::make('platform_accounts_id')
                    ->label('Platform Accounts')
                    ->options(PlatformAccount::pluck('username', 'id')->toArray())
                    ->placeholder('Filter by platform account'),
//                SelectFilter::make('platform_accounts_id')
//                    ->label('Platform Accounts')
//                    ->relationship('platformAccounts', 'username', fn(Builder $query) => $query),
                SelectFilter::make('currency_id')
                    ->label('Currency')
                    ->relationship('currency', 'name', fn(Builder $query) => $query),
                SelectFilter::make('crypto_currency_id')
                    ->label('Crypto Currency')
                    ->relationship('cryptoCurrency', 'name', fn(Builder $query) => $query),
                SelectFilter::make('payment_mode_id')
                    ->label('Payment Mode')
                    ->relationship('paymentMode', 'name', fn(Builder $query) => $query),
            ])
            ->actions([])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    public function getSelectOptionsForPlatformAccountId($value, $state)
    {
        if ($value) {
            $platform = Platform::find($value);
            if ($platform) {
                return PlatformAccount::where('platform_id', $platform->id)
                    ->pluck('username', 'id')
                    ->toArray();
            }
        }
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
