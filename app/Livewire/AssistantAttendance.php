<?php

namespace App\Livewire;

use App\Models\AssistantAttendance as AssistantAttendanceModel;
use App\Models\Rfid;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AssistantAttendance extends Component implements HasForms
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
                Forms\Components\Select::make('meet_id')
                    ->label('Meeting')
                    ->relationship('meets', 'meet_count')
                    ->required(),
                Forms\Components\TextInput::make('rfid')
                    ->label('RFID')
                    ->placeholder('Tempelkan Kartu pada perangkat')
                    ->readonly()
                    ->required(),
            ])
            ->statePath('data')
            ->model(AssistantAttendanceModel::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = AssistantAttendanceModel::create($data);

        DB::table('rfids')->delete();

        $this->form->model($record)->saveRelationships();

        $this->reset(['data']);
        $this->updateRfid();
    }

    public function render(): View
    {
        return view('livewire.assistant-attendance');
    }
}
