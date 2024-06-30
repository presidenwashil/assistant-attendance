<?php

namespace App\Filament\Resources\DayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodsRelationManager extends RelationManager
{
    protected static string $relationship = 'periods';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Select::make('start')
                    ->options([
                        '08:00:00' => '08:00:00',
                        '09:30:00' => '09:30:00',
                        '11:00:00' => '11:00:00',
                        '12:30:00' => '12:30:00',
                        '14:00:00' => '14:00:00',
                        '15:30:00' => '15:30:00',
                        '17:00:00' => '17:00:00',
                        '19:00:00' => '19:00:00',
                        '20:30:00' => '20:30:00',
                    ])
                    ->required()
                    ->placeholder('Select the start time')
                    ->native(false),
                Select::make('end')
                    ->options([
                        '09:30:00' => '09:30:00',
                        '11:00:00' => '11:00:00',
                        '12:30:00' => '12:30:00',
                        '14:00:00' => '14:00:00',
                        '15:30:00' => '15:30:00',
                        '17:00:00' => '17:00:00',
                        '18:30:00' => '18:30:00',
                        '20:30:00' => '20:30:00',
                        '22:00:00' => '22:00:00',
                    ])
                    ->required()
                    ->placeholder('Select the end time')
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('start'),
                Tables\Columns\TextColumn::make('end'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
