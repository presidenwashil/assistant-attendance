<?php

namespace App\Livewire;

use App\Models\Assistant;
use App\Models\AssistantMeet;
use App\Models\Meet;
use App\Models\Rfid;
use App\Models\Schedule;
use Livewire\Component;

class PresensiLabPemrograman extends Component
{
    public $rfid = '';

    public $name = '';

    public $rfidExists = null;

    public $hasAttended = '';

    public $roomFull = false;

    public $ongoingPeriod = null;

    protected $listeners = ['refreshRfid'];

    public function resetValues()
    {
        $this->rfid = '';
        $this->name = '';
        $this->rfidExists = null;
        $this->hasAttended = false;
        $this->roomFull = false;
        $this->ongoingPeriod = null;
    }

    public function render()
    {
        return view('livewire.presensi-lab-pemrograman');
    }

    public function mount()
    {
        $this->resetValues();
        $this->updateRfid();
    }

    public function updateRfid()
    {
        $this->resetValues();

        $latestRfid = Rfid::latest()->first();
        $currentDay = now()->format('l');
        $currentTime = now()->format('H:i:s');
        $room = 'Pemrograman';

        if (!$latestRfid) {
            Rfid::truncate();
            return;
        }

        $this->rfid = $latestRfid->rfid;

        $ongoingPeriod = Schedule::with('group', 'period', 'period.day', 'room')
            ->whereHas('room', function ($query) use ($room) {
                $query->where('name', $room);
            })
            ->whereHas('period.day', function ($query) use ($currentDay) {
                $query->where('name', $currentDay);
            })
            ->whereHas('period', function ($query) use ($currentTime) {
                $query->where('start', '<=', $currentTime)
                    ->where('end', '>=', $currentTime);
            })
            ->first();

        if (!$ongoingPeriod) {
            $this->ongoingPeriod = null; // Ensure ongoingPeriod is null if not found
            $this->rfidExists = true; // Ensure rfidExists is true to trigger message
            return;
        }

        $this->ongoingPeriod = $ongoingPeriod;

        $totalMeetCount = Meet::where('group_id', $ongoingPeriod->group_id)
            ->count('meet_count');

        $newMeetCount = $totalMeetCount + 1;

        if (!$totalMeetCount) {
            $newMeetCount = 1;
        }

        $meet = Meet::firstOrCreate([
            'group_id' => $ongoingPeriod->group_id,
            'period_id' => $ongoingPeriod->period_id,
            'date' => now()->format('Y-m-d'),
        ], [
            'meet_count' => $newMeetCount
        ]);

        $roomSlot = AssistantMeet::where('meet_id', $meet->id)->sum('slot_used');

        if ($roomSlot >= $ongoingPeriod->room->slots) {
            $this->roomFull = true;
            $this->hasAttended = true;
            Rfid::truncate();
            return;
        }

        $assistant = Assistant::where('rfid', $this->rfid)->first();

        if (!$assistant) {
            $this->rfidExists = false;
            $this->name = null;
            Rfid::truncate();
            return;
        }

        $this->rfidExists = true;
        $this->name = $assistant->name;

        $alreadyAttended = AssistantMeet::where('meet_id', $meet->id)
            ->where('assistant_id', $assistant->id)
            ->first();

        if (!$alreadyAttended) {
            AssistantMeet::create([
                'meet_id' => $meet->id,
                'assistant_id' => $assistant->id,
                'slot_used' => 1
            ]);
            $this->hasAttended = true;
        }

        Rfid::truncate();
    }
}
