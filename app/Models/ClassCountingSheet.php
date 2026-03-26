<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassCountingSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_key',
        'date',
        'branch_id',
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

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
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


    public function getTotalClassAttribute(): int
    {
        $query = self::query();

        if (!empty($this->group_key)) {
            $query->where('group_key', $this->group_key);
        } else {
            $query->whereKey($this->getKey());
        }

        return (int) $query->sum('class_count');
    }

}
