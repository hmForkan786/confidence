<?php

namespace App\Filament\Resources\ClassCountingSheets\Schemas;

use App\Models\ClassCountingSheet;
use Illuminate\Support\Carbon;
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
                TextEntry::make('lecture_details')
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
                            return '-';
                        }

                        $lines = $records->map(function (ClassCountingSheet $item) {
                            $batch = $item->batch?->name ?? 'Unknown';
                            $subject = $item->subject?->name ?? 'Unknown';
                            $teacher = $item->teacher?->name ?? 'Unknown';
                            $time = $item->timeSlot?->time
                                ? Carbon::parse($item->timeSlot->time)->format('h:i A')
                                : 'Unknown';
                            $count = (int) ($item->class_count ?? 0);
                            $topic = $item->topic ?: '-';

                            return $batch . ' | ' . $subject . ' | ' . $teacher . ' | ' . $time . ' | ' . $count . ' | ' . $topic;
                        })->all();

                        return implode('<br>', $lines);
                    })
                    ->html(),
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
