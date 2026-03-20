<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'source',
        'category',
        'description',
        'amount',
        'receipt_image',
        'remark',
        'date',
        'entries',
    ];

    protected $casts = [
        'date' => 'date',
        'entries' => 'array',
        'amount' => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
