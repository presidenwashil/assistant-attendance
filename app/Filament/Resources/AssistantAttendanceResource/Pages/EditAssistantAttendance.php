<?php

namespace App\Filament\Resources\AssistantAttendanceResource\Pages;

use App\Filament\Resources\AssistantAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssistantAttendance extends EditRecord
{
    protected static string $resource = AssistantAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
