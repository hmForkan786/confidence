<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassCountingSheet extends Model
{
    protected $fillable = [
        'date',
        'teacher_id',
        'subject_id',
        'batch_id',
        'time_slot_id',
        'class_count',
        'topic',
        'remark',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }
}
