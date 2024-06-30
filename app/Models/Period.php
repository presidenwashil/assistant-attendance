<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'schedules')
            ->withTimestamps();
    }
}
