<?php

namespace App\Filament\Resources\Transfers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransferInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('fromBranch.name')
                    ->label('From branch'),
                TextEntry::make('toBranch.name')
                    ->label('To branch'),
                TextEntry::make('fromBatch.name')
                    ->label('From batch'),
                TextEntry::make('toBatch.name')
                    ->label('To batch'),
                TextEntry::make('old_roll'),
                TextEntry::make('new_roll'),
                TextEntry::make('old_mr_no'),
                TextEntry::make('new_mr_no'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('remark')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
