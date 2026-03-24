<?php

namespace App\Filament\Resources\ClassCountingSheets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClassCountingSheetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('teacher.name')
                    ->label('Teacher'),
                TextEntry::make('subject.name')
                    ->label('Subject'),
                TextEntry::make('batch.name')
                    ->label('Batch'),
                TextEntry::make('timeSlot.time')
                    ->label('Time slot')
                    ->time('h:i A'),
                TextEntry::make('class_count')
                    ->numeric(),
                TextEntry::make('topic'),
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
