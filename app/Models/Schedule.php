<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
