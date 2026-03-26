<?php

namespace App\Filament\Resources\DailyReportings\Tables;

use App\Models\DailyReporting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DailyReportingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('branch.name')
                    ->label('Branch')
                    ->searchable(),
                TextColumn::make('batch_names')
                    ->label('Batches')
                    ->state(fn (DailyReporting $record) => $record->batch_names),
                TextColumn::make('total_admission')
                    ->label('Admission Count')
                    ->state(fn (DailyReporting $record) => $record->total_admission)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 0))
                    ->sortable(),
                TextColumn::make('opening_balance')
                    ->label('Opening Balance')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_income')
                    ->label('Total Income')
                    ->state(fn (DailyReporting $record) => $record->total_income)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2))
                    ->sortable(),
                TextColumn::make('total_expense')
                    ->label('Total Expense')
                    ->state(fn (DailyReporting $record) => $record->total_expense)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2))
                    ->sortable(),
                TextColumn::make('bank_deposit_amount')
                    ->label('Bank Deposit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cash_in_hand')
                    ->label('Cash in Hand')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
