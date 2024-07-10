<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Rawilk\FilamentPasswordInput\Password;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone'),
                TextInput::make('email')
                    ->email()
                    ->required(),
                Password::make('password')
                    ->password()
                    ->required()
                    ->afterStateUpdated(fn ($state, $set) => $set('password', Hash::make($state))),
            ]);
    }
}
