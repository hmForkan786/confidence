<?php

namespace App\Filament\Resources\ClassCountingSheets\Schemas;

use App\Models\ClassCountingSheet;
use Filament\Infolists\Components\RepeatableEntry;
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
                TextEntry::make('time_slot_names')
                    ->label('Time slot'),
                RepeatableEntry::make('lecture_details')
                    ->label('Lecture Details')
                    ->state(function (ClassCountingSheet $record) {
                        $query = ClassCountingSheet::query()
                            ->with(['teacher', 'subject', 'batch', 'timeSlot'])
                            ->orderBy('id');

                        if (!empty($record->group_key)) {
                            $query->where('group_key', $record->group_key);
                        } else {
                            $query->whereKey($record->getKey());
                        }

                        $records = $query->get();

                        if ($records->isEmpty()) {
                            return [];
                        }

                        return $records->map(function (ClassCountingSheet $item) {
                            return [
                                'batch' => $item->batch?->name ?? 'Unknown',
                                'subject' => $item->subject?->name ?? 'Unknown',
                                'teacher' => $item->teacher?->name ?? 'Unknown',
                                'time' => $item->time_slot_names,
                                'count' => (int) ($item->class_count ?? 0),
                                'topic' => $item->topic ?: '-',
                            ];
                        })->all();
                    })
                    ->schema([
                        TextEntry::make('batch')
                            ->label('Batch'),
                        TextEntry::make('subject')
                            ->label('Subject'),
                        TextEntry::make('teacher')
                            ->label('Teacher'),
                        TextEntry::make('time')
                            ->label('Time'),
                        TextEntry::make('count')
                            ->label('Class Count'),
                        TextEntry::make('topic')
                            ->label('Topic'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
                TextEntry::make('total_class')
                    ->label('Total Class')
                    ->state(fn ($record) => $record->total_class)
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
