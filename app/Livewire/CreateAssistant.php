<?php

namespace App\Livewire;

use App\Models\Assistant;
use App\Models\Rfid;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAssistant extends Component
{
    public $code = '';
    public $name = '';
    public $rfid = '';

    protected $listeners = ['refreshRfid'];

    public function mount()
    {
        $this->updateRfid();
    }

    public function updateRfid()
    {
        $latestRfid = Rfid::latest()->first();
        if ($latestRfid) {
            $this->rfid = $latestRfid->rfid;
        }
    }

    public function save()
    {
        Assistant::create([
            'code' => $this->code,
            'name' => $this->name,
            'rfid' => $this->rfid,
        ]);

        DB::table('rfids')->delete();

        $this->js("alert('Post saved!')");

        $this->reset(['code', 'name', 'rfid']);
    }

    public function render()
    {
        return view('livewire.create-assistant');
    }
}
