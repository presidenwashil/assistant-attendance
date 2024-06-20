<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    public function assistants()
    {
        return $this->belongsToMany(Assistant::class);
    }
}
