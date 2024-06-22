<?php

namespace App\Livewire;

use App\Models\Assistant;
use App\Models\Rfid;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class AssistantForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected $listeners = ['refreshRfid'];

    public function mount(): void
    {
        $this->updateRfid();
        $this->form->fill();
    }

    public function updateRfid()
    {
        $latestRfid = Rfid::latest()->first();
        if ($latestRfid) {
            $this->data['rfid'] = $latestRfid->rfid;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('rfid')
                    ->label('RFID')
                    ->placeholder('Tempelkan Kartu pada perangkat')
                    ->readonly()
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
            ])
            ->statePath('data')
            ->model(Assistant::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Assistant::create($data);

        DB::table('rfids')->delete();

        $this->form->model($record)->saveRelationships();

        Notification::make()
            ->title('Assistant Created')
            ->body('Assistant has been created successfully.')
            ->success()
            ->send();

        $this->reset(['data']);
        $this->updateRfid();
    }

    public function render(): View
    {
        return view('livewire.assistant-form');
    }
}
