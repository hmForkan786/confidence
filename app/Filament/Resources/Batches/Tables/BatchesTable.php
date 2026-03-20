<?php

namespace App\Filament\Resources\Batches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('total_class')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('duration')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(function (?string $state): ?string {
                        if ($state === null) {
                            return null;
                        }

                        return [
                            'offline_exam' => 'Offline exam',
                            'offline_regular' => 'Offline regular',
                            'online_regular' => 'Online regular',
                            'online_exam' => 'Online exam',
                            'offline_online' => 'Offline+Online',
                        ][$state] ?? $state;
                    }),
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
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
