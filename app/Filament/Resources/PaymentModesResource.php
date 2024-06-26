<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentModesResource\Pages;
use App\Filament\Resources\PaymentModesResource\RelationManagers;
use App\Models\PaymentMode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentModesResource extends Resource
{
    protected static ?string $model = PaymentMode::class;

    protected static ?string $navigationGroup = 'Relationships';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentModes::route('/'),
            'create' => Pages\CreatePaymentModes::route('/create'),
            'edit' => Pages\EditPaymentModes::route('/{record}/edit'),
        ];
    }
}
