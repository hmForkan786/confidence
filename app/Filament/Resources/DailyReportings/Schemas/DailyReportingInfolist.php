<?php

namespace App\Filament\Resources\DailyReportings\Schemas;

use App\Models\Batch;
use App\Models\Expense;
use App\Models\Income;
use App\Models\DailyReporting;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DailyReportingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('batch_names')
                    ->label('Batches')
                    ->state(fn (DailyReporting $record) => $record->batch_names),
                TextEntry::make('total_admission')
                    ->label('Admission Count')
                    ->state(fn (DailyReporting $record) => $record->total_admission)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 0)),
                TextEntry::make('admission_items')
                    ->label('Admission Details')
                    ->state(function (DailyReporting $record) {
                        $items = $record->admission_items ?? [];

                        if (empty($items)) {
                            return '-';
                        }

                        $batchIds = collect($items)->pluck('batch_id')->filter()->unique()->values();
                        $batchNames = Batch::query()->whereIn('id', $batchIds)->pluck('name', 'id');

                        $lines = collect($items)
                            ->map(function ($item) use ($batchNames) {
                                $batchId = $item['batch_id'] ?? null;
                                $name = $batchId ? ($batchNames[$batchId] ?? 'Unknown') : 'Unknown';
                                $count = (float) ($item['count'] ?? $item['amount'] ?? 0);

                                return $name . ' - ' . number_format($count, 0);
                            })
                            ->filter()
                            ->values()
                            ->all();

                        return $lines ? implode('<br>', $lines) : '-';
                    })
                    ->html(),
                TextEntry::make('opening_balance')
                    ->label('Opening Balance')
                    ->numeric(),
                TextEntry::make('total_income')
                    ->label('Total Income')
                    ->state(fn (DailyReporting $record) => $record->total_income)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2)),
                TextEntry::make('income_items')
                    ->label('Income Details')
                    ->state(function (DailyReporting $record) {
                        $items = $record->income_items ?? [];

                        if (empty($items)) {
                            return '-';
                        }

                        $incomeIds = collect($items)->pluck('income_id')->filter()->unique()->values();
                        $incomeNames = Income::query()->whereIn('id', $incomeIds)->pluck('name', 'id');

                        $lines = collect($items)
                            ->map(function ($item) use ($incomeNames) {
                                $incomeId = $item['income_id'] ?? null;
                                $name = $incomeId ? ($incomeNames[$incomeId] ?? 'Unknown') : 'Unknown';
                                $amount = (float) ($item['amount'] ?? 0);

                                return $name . ' - ' . number_format($amount, 2);
                            })
                            ->filter()
                            ->values()
                            ->all();

                        return $lines ? implode('<br>', $lines) : '-';
                    })
                    ->html(),
                TextEntry::make('total_expense')
                    ->label('Total Expense')
                    ->state(fn (DailyReporting $record) => $record->total_expense)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2)),
                TextEntry::make('expense_items')
                    ->label('Expense Details')
                    ->state(function (DailyReporting $record) {
                        $items = $record->expense_items ?? [];

                        if (empty($items)) {
                            return '-';
                        }

                        $expenseIds = collect($items)->pluck('expense_id')->filter()->unique()->values();
                        $expenseNames = Expense::query()->whereIn('id', $expenseIds)->pluck('name', 'id');

                        $lines = collect($items)
                            ->map(function ($item) use ($expenseNames) {
                                $expenseId = $item['expense_id'] ?? null;
                                $name = $expenseId ? ($expenseNames[$expenseId] ?? 'Unknown') : 'Unknown';
                                $amount = (float) ($item['amount'] ?? 0);

                                return $name . ' - ' . number_format($amount, 2);
                            })
                            ->filter()
                            ->values()
                            ->all();

                        return $lines ? implode('<br>', $lines) : '-';
                    })
                    ->html(),
                TextEntry::make('bank_deposit_amount')
                    ->label('Bank Deposit Amount')
                    ->numeric(),
                TextEntry::make('cash_in_hand')
                    ->label('Cash in Hand')
                    ->numeric(),
                ImageEntry::make('receipt_image')
                    ->label('Receipt')
                    ->placeholder('-'),
                ImageEntry::make('bank_deposit_slip')
                    ->label('Bank Deposit Slip')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
