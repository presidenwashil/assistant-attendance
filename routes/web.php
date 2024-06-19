<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\RfidController;
use App\Livewire\CreateAssistant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nokartu', [RfidController::class, 'nokartu']);

Route::resource('/assistant', AssistantController::class);

// Route::get('/assistants/create', CreateAssistant::class)->name('assistants.create');
