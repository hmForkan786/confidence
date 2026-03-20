<?php

namespace App\Filament\Resources\ClassSessions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClassSessionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('teacher.name')
                    ->label('Teacher'),
                TextEntry::make('batch.name')
                    ->label('Batch'),
                TextEntry::make('timeSlot.time')
                    ->label('Time slot')
                    ->time('h:i A'),
                TextEntry::make('subject.name')
                    ->label('Subject'),
                TextEntry::make('lecture_no')
                    ->numeric(),
                TextEntry::make('class_date')
                    ->date(),
                TextEntry::make('topic')
                    ->placeholder('-'),
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
