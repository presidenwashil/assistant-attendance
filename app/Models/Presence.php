<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function assistant()
    {
        return $this->belongsTo(Assistant::class, 'rfid', 'rfid');
    }
}
