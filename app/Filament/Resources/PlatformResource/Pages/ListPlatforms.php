<?php

namespace App\Filament\Resources\PlatformResource\Pages;

use App\Filament\Resources\PlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ListPlatforms extends ListRecords
{
    protected static string $resource = PlatformResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name'),
                ImageColumn::make('icon')
                    ->getStateUsing(fn($record) => $record->getFirstMediaUrl('platform_icon', 'url'))
                    ->defaultImageUrl('https://app.nearonly.com/img/main/ic_dummy_image.png')
                    ->extraImgAttributes(['style' => 'object-fit: cover; width: auto; height: 4rem;'])
                    ->square(),
                ToggleColumn::make('status'),
            ])
            ->filters([])
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
