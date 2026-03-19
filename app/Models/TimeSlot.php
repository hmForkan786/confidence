<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $fillable = [
        'time',
    ];

    public function classSessions(): HasMany
    {
        return $this->hasMany(ClassSession::class, 'time_slot_id');
    }
}
