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
                TextColumn::make('old_roll')
                    ->searchable(),
                TextColumn::make('new_roll')
                    ->searchable(),
                TextColumn::make('old_mr_no')
                    ->searchable(),
                TextColumn::make('new_mr_no')
                    ->searchable(),
                TextColumn::make('amount')
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
