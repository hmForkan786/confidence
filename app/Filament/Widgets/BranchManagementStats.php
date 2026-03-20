<?php

namespace App\Filament\Widgets;

use App\Models\BranchManagement;
use App\Models\Expense;
use App\Models\Income;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class BranchManagementStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        $totalIncome = (float) Income::query()
            ->whereDate('date', $today)
            ->sum('amount');

        $totalExpense = (float) Expense::query()
            ->whereDate('date', $today)
            ->sum('amount');

        $totalAdmission = (float) BranchManagement::query()
            ->forDate($today)
            ->sum('today_admission');

        $totalCashInHand = BranchManagement::query()
            ->forDate($today)
            ->withDailyTotals()
            ->get()
            ->sum(fn (BranchManagement $record) => $record->cash_in_hand);

        return [
            Stat::make('Total Income Today', number_format($totalIncome, 2)),
            Stat::make('Total Expense Today', number_format($totalExpense, 2)),
            Stat::make('Total Cash in Hand', number_format((float) $totalCashInHand, 2)),
            Stat::make('Total Admission Today', number_format($totalAdmission, 0)),
        ];
    }
}
