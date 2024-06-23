<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'rfid'];

    public function presences()
    {
        return $this->hasMany(Presence::class, 'rfid', 'rfid');
    }
}
