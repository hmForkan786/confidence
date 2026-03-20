<?php

namespace App\Filament\Resources\BranchManagement\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchManagementTable
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
                TextColumn::make('opening_balance')
                    ->label('Opening Balance')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('today_admission')
                    ->label('Today Admission')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('today_income')
                    ->label('Today Income')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('today_expense')
                    ->label('Today Expense')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('today_bank_deposit')
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
            ->filters([
                SelectFilter::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Branch'),
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')
                            ->label('From'),
                        DatePicker::make('to')
                            ->label('To'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->betweenDates($data['from'] ?? null, $data['to'] ?? null);
                    }),
            ])
            ->modifyQueryUsing(fn ($query) => $query->withDailyTotals())
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
