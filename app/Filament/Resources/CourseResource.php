<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\RelationManagers\GroupsRelationManager;
use App\Models\Course;
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

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->unique()
                    ->placeholder('Enter the course code')
                    ->autofocus(),
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Enter the course name'),
                Select::make('credit')
                    ->label('Credits')
                    ->options([
                        1 => '1 Credit',
                        2 => '2 Credits',
                        3 => '3 Credits',
                        4 => '4 Credits',
                        5 => '5 Credits',
                        6 => '6 Credits',
                        7 => '7 Credits',
                        8 => '8 Credits',
                    ])
                    ->required()
                    ->placeholder('Select the credits'),
                Select::make('semester')
                    ->label('Semester')
                    ->options([
                        1 => '1st Semester',
                        2 => '2nd Semester',
                        3 => '3rd Semester',
                        4 => '4th Semester',
                        5 => '5th Semester',
                        6 => '6th Semester',
                        7 => '7th Semester',
                        8 => '8th Semester',
                    ])
                    ->required()
                    ->placeholder('Select the semester'),
                Select::make('major_id')
                    ->label('Major')
                    ->relationship('major', 'name')
                    ->required()
                    ->placeholder('Select the major'),
                Select::make('grade_id')
                    ->label('Grade')
                    ->relationship('grade', 'name')
                    ->required()
                    ->placeholder('Select the grade'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('credit')
                    ->label('Credits')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('major.name')
                    ->label('Major')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('grade.name')
                    ->label('Grade')
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
            GroupsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
