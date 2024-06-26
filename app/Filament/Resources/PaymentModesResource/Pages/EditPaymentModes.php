<?php

namespace App\Filament\Resources\PaymentModesResource\Pages;

use App\Filament\Resources\PaymentModesResource;
use Filament\Actions;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditPaymentModes extends EditRecord
{
    protected static string $resource = PaymentModesResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('symbol'),
                SpatieMediaLibraryFileUpload::make('payment_mode_icon')
                    ->collection('payment_mode_icon')
                    ->image()->columnSpanFull(),
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
