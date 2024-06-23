<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
