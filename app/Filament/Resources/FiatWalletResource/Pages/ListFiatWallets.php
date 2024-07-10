<?php

namespace App\Filament\Resources\FiatWalletResource\Pages;

use App\Filament\Resources\FiatWalletResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListFiatWallets extends ListRecords
{
    protected static string $resource = FiatWalletResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name'),
                TextColumn::make('symbol_with_amount')
                    ->label('Amount'),
                TextColumn::make('type_of_user'),
                TextColumn::make('user.name'),
                TextColumn::make('paymentMode.name'),
                TextColumn::make('symbol_with_paid_amount')
                    ->label('Paid Amount'),
            ])
            ->filters([
                SelectFilter::make('type_of_user')
                    ->label('Type of User')
                    ->options([
                        'internal' => 'Internal',
                        'external' => 'External',
                        'client' => 'Client',
                    ]),
                SelectFilter::make('payment_mode_id')
                    ->label('Payment Mode')
                    ->relationship('paymentMode', 'name', fn(Builder $query) => $query),
            ])
            ->actions([])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
