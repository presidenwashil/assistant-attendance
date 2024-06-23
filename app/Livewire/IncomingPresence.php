<?php

namespace App\Livewire;

use App\Models\Assistant;
use App\Models\Presence;
use App\Models\Rfid;
use Carbon\Carbon;
use Livewire\Component;

class IncomingPresence extends Component
{
    public $rfid = '';

    public $name = '';

    public $hasAttended = false;

    public $activeTab = 'masuk';

    protected $listeners = ['refreshRfid'];

    public function mount()
    {
        $this->updateRfid();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updateRfid()
    {
        $latestRfid = Rfid::latest()->first();
        if ($latestRfid) {
            $this->rfid = $latestRfid->rfid;

            $assistant = Assistant::where('rfid', $this->rfid)->first();
            if ($assistant) {

                $this->name = $assistant->name;
                $this->hasAttended = false; // Inisialisasi status absensi

                $date = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d');

                if ($this->activeTab == 'masuk') {
                    $attendanceExists = Presence::where('rfid', $this->rfid)
                        ->whereDate('date', $date)
                        ->exists();
                    if (!$attendanceExists) {
                        Presence::create([
                            'rfid' => $this->rfid,
                            'date' => $date,
                            'in' => Carbon::now('Asia/Kuala_Lumpur')->format('H:i:s'),
                        ]);
                    } else {
                        $this->hasAttended = true; // Absensi sudah dilakukan
                    }

                    Rfid::truncate();

                } elseif ($this->activeTab == 'keluar') {
                    $presence = Presence::where('rfid', $this->rfid)
                        ->whereDate('date', $date)
                        ->first();
                    if ($presence && is_null($presence->out)) {
                        $presence->update([
                            'out' => Carbon::now('Asia/Kuala_Lumpur')->format('H:i:s'),
                        ]);
                    } else if ($presence && !is_null($presence->out)) {
                        $this->hasAttended = true;
                    }

                    Rfid::truncate();
                }
            } else {
                $this->name = null;
            }
        } else {
            $this->name = null;
        }
    }

    public function render()
    {
        return view('livewire.incoming-presence', ['activeTab' => $this->activeTab]);
    }
}
