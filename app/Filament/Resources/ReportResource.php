<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('value')
                    ->label(__('filament.resources.reports.fields.value'))
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('comment')
                    ->label(__('filament.resources.reports.fields.comment'))
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label(__('filament.resources.reports.fields.user_id'))
                    ->relationship('user', 'name'),
                Forms\Components\DateTimePicker::make('reported_at')
                    ->label(__('filament.resources.reports.fields.reported_at'))
                    ->jalali()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament.resources.reports.fields.value'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.resources.reports.fields.user_id'))
                    ->numeric()
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->label(__('filament.resources.reports.fields.level'))
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament.resources.reports.fields.comment'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('reported_at')
                    ->label(__('filament.resources.reports.fields.reported_at'))
                    ->jalaliDateTime('l j F Y - H:i')
                    ->sortable(),
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
            'index' => Pages\ManageReports::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.reports.plural_label');
    }

    public static function getLabel(): ?string
    {
        return __('filament.resources.reports.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('filament.resources.reports.plural_label');
    }
}
