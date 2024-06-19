<?php

namespace App\Livewire;

use App\Models\Assistant;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAssistant extends Component
{
    public $code = '';
    public $name = '';
    public $rfid = '';

    public function updateRfid($value)
    {
        $this->rfid = $value;
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
