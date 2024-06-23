<?php

namespace App\Filament\Resources\AssistantAttendanceResource\Pages;

use App\Filament\Resources\AssistantAttendanceResource;
use Filament\Resources\Pages\Page;

class AssistantAttendance extends Page
{
    protected static string $resource = AssistantAttendanceResource::class;

    protected static string $view = 'filament.resources.assistant-attendance-resource.pages.assistant-attendance';
}
