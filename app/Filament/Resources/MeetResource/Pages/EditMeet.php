<?php

namespace App\Filament\Resources\MeetResource\Pages;

use App\Filament\Resources\MeetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeet extends EditRecord
{
    protected static string $resource = MeetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
