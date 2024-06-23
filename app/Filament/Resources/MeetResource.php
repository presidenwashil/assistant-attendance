<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetResource\Pages;
use App\Filament\Resources\MeetResource\RelationManagers;
use App\Models\Meet;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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
                    ->label('Course Group')
                    ->relationship('group', 'name')
                    ->required()
                    ->placeholder('Select the course group'),
                Select::make('meet_count')
                    ->label('Meet Count')
                    ->options([
                        1 => '1 Meet',
                        2 => '2 Meets',
                        3 => '3 Meets',
                        4 => '4 Meets',
                        5 => '5 Meets',
                        6 => '6 Meets',
                        7 => '7 Meets',
                        8 => '8 Meets',
                    ])
                    ->required()
                    ->placeholder('Select the meet count'),
                DatePicker::make('date')
                    ->label('Date')
                    ->required()
                    ->placeholder('Select the date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group.course.name'),
                TextColumn::make('group.name'),
                TextColumn::make('meet_count'),
                TextColumn::make('date'),
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
            'index' => Pages\ListMeets::route('/'),
            'create' => Pages\CreateMeet::route('/create'),
            'edit' => Pages\EditMeet::route('/{record}/edit'),
        ];
    }
}
