<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\RfidController;
use App\Livewire\CreateAssistant;
use App\Livewire\IncomingPresence;
use Illuminate\Support\Facades\Route;

Route::get('/', IncomingPresence::class)->name('presence');

Route::get('/nokartu', [RfidController::class, 'nokartu']);

Route::resource('/assistant', AssistantController::class);
