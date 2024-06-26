<?php

namespace App\Filament\Resources\PlatformAccountResource\Pages;

use App\Filament\Resources\PlatformAccountResource;
use App\Models\Platform;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditPlatformAccount extends EditRecord
{
    protected static string $resource = PlatformAccountResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('platform_id')
                    ->label('Platform')
                    ->options(Platform::pluck('name', 'id')->toArray())
                    ->columnSpanFull(),
                TextInput::make('username'),
                TextInput::make('balance')
                    ->label('Balance (USDT)'),
                Textarea::make('login_details'),
                Textarea::make('note'),
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
