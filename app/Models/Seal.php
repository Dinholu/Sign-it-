<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seal extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'token', 'sha1', 'meeting_id'];

    public function meetings()
    {
        return $this->hasOne(Meeting::class, 'meeting_id');
    }
}
