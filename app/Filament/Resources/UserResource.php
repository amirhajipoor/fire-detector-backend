<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('mobile')
                    ->label(__('filament.resources.users.fields.mobile')),
                Forms\Components\TextInput::make('password')
                    ->label(__('filament.resources.users.fields.password'))
                    ->password(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.users.fields.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament.resources.users.fields.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label(__('filament.resources.users.fields.mobile'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.resources.users.fields.created_at'))
                    ->jalaliDateTime('l j F Y - H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.resources.users.fields.updated_at'))
                    ->jalaliDateTime('l j F Y - H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.users.plural_label');
    }

    public static function getLabel(): ?string
    {
        return __('filament.resources.users.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('filament.resources.users.plural_label');
    }
}
