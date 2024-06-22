<?php

namespace App\Filament\Resources\AssistantResource\Pages;

use App\Filament\Resources\AssistantResource;
use App\Livewire\CreateAssistant as LivewireCreateAssistant;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssistant extends CreateRecord
{
    protected static string $resource = AssistantResource::class;

}
