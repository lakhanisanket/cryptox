<?php

namespace App\Filament\Resources\ExpensesResource\Pages;

use App\Filament\Resources\ExpensesResource;
use App\Models\Currency;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditExpenses extends EditRecord
{
    protected static string $resource = ExpensesResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('amount'),
                Select::make('currency_id')
                    ->label('Currency')
                    ->options(Currency::all()->pluck('name_with_symbol', 'id')),
                TextInput::make('at')
                    ->label('At (Location)'),
                Select::make('by_id')
                    ->label('By (User)')
                    ->options(User::pluck('name', 'id')->toArray()),
                DateTimePicker::make('date_time')
                    ->label('Date & Time'),
                TextArea::make('note')
                    ->columnSpanFull()
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
