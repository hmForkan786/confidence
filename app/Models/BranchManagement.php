<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;
use App\Models\Batch;
use App\Models\Income;
use App\Models\Expense;

class BranchManagement extends Model
{
    use HasFactory;

    protected $table = 'branch_managements';

    protected $fillable = [
        'branch_id',
        'date',
        'opening_balance',
        'today_admission',
        'today_bank_deposit',
        'penalty',
        'remark',
    ];

    protected $casts = [
        'date' => 'date',
        'opening_balance' => 'decimal:2',
        'today_bank_deposit' => 'decimal:2',
        'penalty' => 'decimal:2',
    ];

    protected static ?array $batchStudentSummaryCache = null;

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    public function scopeBetweenDates($query, $from = null, $to = null)
    {
        return $query
            ->when($from, fn ($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn ($q) => $q->whereDate('date', '<=', $to));
    }

    public function scopeWithDailyTotals($query)
    {
        $incomeSub = Income::query()
            ->selectRaw('COALESCE(SUM(amount), 0)')
            ->whereColumn('branch_id', 'branch_managements.branch_id')
            ->whereColumn('date', 'branch_managements.date');

        $expenseSub = Expense::query()
            ->selectRaw('COALESCE(SUM(amount), 0)')
            ->whereColumn('branch_id', 'branch_managements.branch_id')
            ->whereColumn('date', 'branch_managements.date');

        return $query->addSelect([
            'today_income' => $incomeSub,
            'today_expense' => $expenseSub,
        ]);
    }

    public static function calculateTodayIncome(?int $branchId, $date): float
    {
        if (!$branchId || !$date) {
            return 0.0;
        }

        return (float) Income::query()
            ->where('branch_id', $branchId)
            ->whereDate('date', $date)
            ->sum('amount');
    }

    public static function calculateTodayExpense(?int $branchId, $date): float
    {
        if (!$branchId || !$date) {
            return 0.0;
        }

        return (float) Expense::query()
            ->where('branch_id', $branchId)
            ->whereDate('date', $date)
            ->sum('amount');
    }

    public function getTodayIncomeAttribute(): float
    {
        if (array_key_exists('today_income', $this->attributes)) {
            return (float) $this->attributes['today_income'];
        }

        return static::calculateTodayIncome($this->branch_id, $this->date);
    }

    public function getTodayExpenseAttribute(): float
    {
        if (array_key_exists('today_expense', $this->attributes)) {
            return (float) $this->attributes['today_expense'];
        }

        return static::calculateTodayExpense($this->branch_id, $this->date);
    }

    public function getCashInHandAttribute(): float
    {
        $opening = (float) ($this->opening_balance ?? 0);
        $income = (float) $this->today_income;
        $penalty = (float) ($this->penalty ?? 0);
        $expense = (float) $this->today_expense;
        $bankDeposit = (float) ($this->today_bank_deposit ?? 0);

        return $opening + $income + $penalty - $expense - $bankDeposit;
    }

    public static function getBatchStudentSummary(): array
    {
        if (static::$batchStudentSummaryCache !== null) {
            return static::$batchStudentSummaryCache;
        }

        $query = Batch::query()
            ->select('id', 'name')
            ->orderBy('name');

        if (Schema::hasColumn('batches', 'student_count')) {
            $query->addSelect('student_count');
        }

        $batches = $query->get();

        static::$batchStudentSummaryCache = $batches
            ->mapWithKeys(function ($batch) {
                $count = (int) ($batch->student_count ?? 0);

                return [$batch->name => $count];
            })
            ->all();

        return static::$batchStudentSummaryCache;
    }

    public static function getBatchStudentSummaryText(): string
    {
        $summaries = static::getBatchStudentSummary();

        if (empty($summaries)) {
            return '-';
        }

        return collect($summaries)
            ->map(fn ($count, $name) => $name . ' -> ' . $count . ' students')
            ->implode(PHP_EOL);
    }

    public function getBatchStudentSummariesAttribute(): array
    {
        return static::getBatchStudentSummary();
    }

    public function getBatchStudentSummariesTextAttribute(): string
    {
        return static::getBatchStudentSummaryText();
    }
}
