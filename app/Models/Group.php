<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
