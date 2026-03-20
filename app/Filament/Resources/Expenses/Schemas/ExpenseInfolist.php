<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExpenseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('entries')
                    ->label('Source')
                    ->formatStateUsing(static function (?array $state): string {
                        if (blank($state)) {
                            return '-';
                        }

                        return collect($state)
                            ->pluck('source')
                            ->filter()
                            ->join(', ');
                    }),
                TextEntry::make('category'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('amount')
                    ->numeric(),
                ImageEntry::make('receipt_image'),
                TextEntry::make('remark')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
