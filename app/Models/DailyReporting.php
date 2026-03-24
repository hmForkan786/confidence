<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReporting extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'branch_id',
        'batch_id',
        'admission',
        'opening_balance',
        'income_items',
        'expense_items',
        'receipt_image',
        'bank_deposit_amount',
        'bank_deposit_slip',
        'cash_in_hand',
    ];

    protected $casts = [
        'date' => 'date',
        'opening_balance' => 'decimal:2',
        'bank_deposit_amount' => 'decimal:2',
        'cash_in_hand' => 'decimal:2',
        'income_items' => 'array',
        'expense_items' => 'array',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function getTotalIncomeAttribute(): float
    {
        $items = $this->income_items ?? [];

        return collect($items)
            ->sum(fn ($item) => (float) ($item['amount'] ?? 0));
    }

    public function getTotalExpenseAttribute(): float
    {
        $items = $this->expense_items ?? [];

        return collect($items)
            ->sum(fn ($item) => (float) ($item['amount'] ?? 0));
    }
}
