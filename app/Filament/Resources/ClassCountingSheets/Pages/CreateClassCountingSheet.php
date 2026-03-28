<?php

namespace App\Filament\Resources\ClassCountingSheets\Pages;

use App\Filament\Resources\ClassCountingSheets\ClassCountingSheetResource;
use App\Models\ClassCountingSheet;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateClassCountingSheet extends CreateRecord
{
    protected static string $resource = ClassCountingSheetResource::class;

    protected function handleRecordCreation(array $data): ClassCountingSheet
    {
        $items = $data['lecture_items'] ?? [];

        if (!is_array($items) || count($items) === 0) {
            throw ValidationException::withMessages([
                'lecture_items' => 'Please add at least one lecture item.',
            ]);
        }

        return DB::transaction(function () use ($data, $items): ClassCountingSheet {
            $firstRecord = null;
            $groupKey = (string) Str::uuid();

            foreach ($items as $item) {
                $timeSlotIds = collect($item['time_slot_ids'] ?? [])
                    ->filter()
                    ->values()
                    ->all();

                $record = ClassCountingSheet::create([
                    'group_key' => $groupKey,
                    'date' => $data['date'] ?? null,
                    'branch_id' => $data['branch_id'] ?? null,
                    'teacher_id' => $item['teacher_id'] ?? null,
                    'subject_id' => $item['subject_id'] ?? null,
                    'batch_id' => $item['batch_id'] ?? null,
                    'time_slot_id' => $timeSlotIds[0] ?? null,
                    'time_slot_ids' => $timeSlotIds,
                    'class_count' => $item['class_count'] ?? null,
                    'topic' => $item['lecture'] ?? null,
                    'remark' => $data['remark'] ?? null,
                ]);

                $firstRecord ??= $record;
            }

            return $firstRecord;
        });
    }
}
