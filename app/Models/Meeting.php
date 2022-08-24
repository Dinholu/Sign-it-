<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'place', 'date', 'closing', 'privilege'];

    protected static function booted()
    {
        static::creating(function ($meeting) {
            $meeting->author = auth()->id();
        });
    }
}
