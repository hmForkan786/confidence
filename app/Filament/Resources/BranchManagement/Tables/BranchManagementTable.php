<?php

namespace App\Filament\Resources\BranchManagement\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchManagementTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('branch.name')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('today_admission')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('opening_balance')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('today_total_income')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bank_deposit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_expense')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('penalty_collected')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cash_in_hand')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('foundation_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('preli_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('preli_online_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('exam_count')
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
                //
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
