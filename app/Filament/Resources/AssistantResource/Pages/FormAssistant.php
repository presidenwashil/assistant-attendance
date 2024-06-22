<?php

namespace App\Filament\Resources\AssistantResource\Pages;

use App\Filament\Resources\AssistantResource;
use Filament\Resources\Pages\Page;

class FormAssistant extends Page
{
    protected static string $resource = AssistantResource::class;

    protected static string $view = 'filament.resources.assistant-resource.pages.form-assistant';
}
