<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssistantAttendanceResource\Pages;
use App\Filament\Resources\AssistantAttendanceResource\RelationManagers;
use App\Models\AssistantAttendance;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssistantAttendanceResource extends Resource
{
    protected static ?string $model = AssistantAttendance::class;

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
                TextColumn::make('meets.group.name'),
                TextColumn::make('meets.meet_count'),
                TextColumn::make('assistants.rfid'),
                TextColumn::make('assistants.name'),
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
            'index' => Pages\ListAssistantAttendances::route('/'),
            'create' => Pages\AssistantAttendance::route('/create'),
            'edit' => Pages\EditAssistantAttendance::route('/{record}/edit'),
        ];
    }
}
