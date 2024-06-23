<?php

namespace App\Filament\Resources\AssistantAttendanceResource\Pages;

use App\Filament\Resources\AssistantAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssistantAttendances extends ListRecords
{
    protected static string $resource = AssistantAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
