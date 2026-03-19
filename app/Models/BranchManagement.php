<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchManagement extends Model
{
    protected $table = 'branch_managements';

    protected $fillable = [
        'branch_id',
        'date',
        'today_admission',
        'opening_balance',
        'today_total_income',
        'bank_deposit',
        'total_expense',
        'penalty_collected',
        'cash_in_hand',
        'foundation_count',
        'preli_count',
        'preli_online_count',
        'exam_count',
    ];

    protected $casts = [
        'date' => 'date',
        'opening_balance' => 'decimal:2',
        'today_total_income' => 'decimal:2',
        'bank_deposit' => 'decimal:2',
        'total_expense' => 'decimal:2',
        'penalty_collected' => 'decimal:2',
        'cash_in_hand' => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
