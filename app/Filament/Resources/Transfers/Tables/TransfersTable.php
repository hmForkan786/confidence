<?php

namespace App\Filament\Resources\Transfers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransfersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fromBranch.name')
                    ->searchable(),
                TextColumn::make('toBranch.name')
                    ->searchable(),
                TextColumn::make('fromBatch.name')
                    ->searchable(),
                TextColumn::make('toBatch.name')
                    ->searchable(),
                TextColumn::make('from_branch_roll')
                    ->label('From branch roll')
                    ->searchable(),
                TextColumn::make('to_branch_roll')
                    ->label('To branch roll')
                    ->searchable(),
                TextColumn::make('from_branch_amount')
                    ->label('From branch amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('to_branch_amount')
                    ->label('To branch amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('from_batch_old_roll')
                    ->label('From batch old roll')
                    ->searchable(),
                TextColumn::make('to_batch_new_roll')
                    ->label('To batch new roll')
                    ->searchable(),
                TextColumn::make('from_batch_old_amount')
                    ->label('From batch old amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('to_batch_new_amount')
                    ->label('To batch new amount')
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
