<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_class',
        'status',
        'type',
        'admission_items',
    ];

    protected $casts = [
        'admission_items' => 'array',
    ];

    public function getTotalAdmissionAttribute(): float
    {
        $items = $this->admission_items ?? [];

        return collect($items)
            ->sum(fn ($item) => (float) ($item['count'] ?? 0));
    }
}
