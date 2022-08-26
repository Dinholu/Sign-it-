<?php

namespace App\Models;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'place', 'date', 'closing', 'privilege', 'slug'];

    protected static function booted()
    {
        static::creating(function ($meeting) {
            $meeting->user_id = auth()->id();
        });
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
}
