<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetResource\Pages;
use App\Filament\Resources\MeetResource\RelationManagers;
use App\Filament\Resources\MeetResource\RelationManagers\AssistantsRelationManager;
use App\Models\Group;
use App\Models\Meet;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetResource extends Resource
{
    protected static ?string $model = Meet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group_id')
                    ->options(
                        Group::all()->pluck('name', 'id')
                    )
                    ->required()
                    ->label('Group'),
                TextInput::make('meet_count')
                    ->required()
                    ->label('Meet Count'),
                TextInput::make('date')
                    ->required()
                    ->label('Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group.name')
                    ->label('Group')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('meet_count')
                    ->label('Meet Count')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->searchable()
                    ->sortable(),
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
            AssistantsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeets::route('/'),
            'create' => Pages\CreateMeet::route('/create'),
            'edit' => Pages\EditMeet::route('/{record}/edit'),
        ];
    }
}
