<?php

namespace App\Filament\Resources\ClassCountingSheets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClassCountingSheetsTable
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
                TextColumn::make('teacher.name')
                    ->searchable(),
                TextColumn::make('subject.name')
                    ->searchable(),
                TextColumn::make('batch.name')
                    ->searchable(),
                TextColumn::make('timeSlot.time')
                    ->label('Time slot')
                    ->time('h:i A')
                    ->searchable(),
                TextColumn::make('total_class')
                    ->label('Total Class')
                    ->state(fn ($record) => $record->total_class)
                    ->numeric()
                    ->sortable(),
                TextColumn::make('topic')
                    ->searchable(),
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
