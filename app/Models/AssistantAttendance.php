<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantAttendance extends Model
{
    use HasFactory;

    protected $table = 'assistant_meet';

    public function assistants()
    {
        return $this->belongsTo(Assistant::class, 'rfid', 'rfid');
    }

    public function meets()
    {
        return $this->belongsTo(Meet::class, 'meet_id');
    }
}
