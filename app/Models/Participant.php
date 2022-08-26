<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'firstname', 'email', 'phone', 'ip', 'meeting_id'];

    protected static function booted()
    {
        static::creating(function ($meeting) {
            if (auth()->check()) {
                $meeting->user_id = auth()->id();
            } else {
                $meeting->user_id = null;
            }
        });
    }
    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

    public function users()
    {
        return $this->hasOne(Users::class, 'user_id');
    }
}
