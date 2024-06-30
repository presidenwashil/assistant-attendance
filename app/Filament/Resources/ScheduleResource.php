<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->searchable()
                    ->label('Group')
                    ->required()
                    ->placeholder('Select a group'),
                Select::make('period_id')
                    ->relationship('period', 'code')
                    ->searchable()
                    ->label('Period')
                    ->required()
                    ->placeholder('Select a period'),
                Select::make('room_id')
                    ->relationship('room', 'name')
                    ->searchable()
                    ->label('Room')
                    ->required()
                    ->placeholder('Select a room'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('period.day.name')
                    ->searchable()
                    ->label('Day'),
                TextColumn::make('group.name')
                    ->searchable()
                    ->label('Group'),
                TextColumn::make('period.start')
                    ->searchable()
                    ->label('Start'),
                TextColumn::make('period.end')
                    ->searchable()
                    ->label('End'),

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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
