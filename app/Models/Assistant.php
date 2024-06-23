<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'rfid'];

    public function meets()
    {
        return $this->belongsToMany(Meet::class, 'assistant_meet');
    }
}
