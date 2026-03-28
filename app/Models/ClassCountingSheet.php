<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
        'time_slot_ids',
        'class_count',
        'topic',
        'remark',
    ];

    protected $casts = [
        'date' => 'date',
        'time_slot_ids' => 'array',
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

    public function getTimeSlotNamesAttribute(): string
    {
        $ids = $this->time_slot_ids ?? [];

        if (empty($ids) && $this->time_slot_id) {
            $ids = [$this->time_slot_id];
        }

        if (empty($ids)) {
            return '-';
        }

        $times = TimeSlot::query()
            ->whereIn('id', $ids)
            ->orderBy('time')
            ->pluck('time')
            ->all();

        if (empty($times)) {
            return '-';
        }

        $formatted = collect($times)
            ->map(fn ($time) => Carbon::parse($time)->format('h:i A'))
            ->all();

        return implode(', ', $formatted);
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
