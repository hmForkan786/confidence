<?php

namespace App\Filament\Resources\ClassCountingSheets\Pages;

use App\Filament\Resources\ClassCountingSheets\ClassCountingSheetResource;
use App\Models\ClassCountingSheet;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
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

            foreach ($items as $item) {
                $record = ClassCountingSheet::create([
                    'date' => $data['date'] ?? null,
                    'branch_id' => $data['branch_id'] ?? null,
                    'teacher_id' => $item['teacher_id'] ?? null,
                    'subject_id' => $item['subject_id'] ?? null,
                    'batch_id' => $item['batch_id'] ?? null,
                    'time_slot_id' => $item['time_slot_id'] ?? null,
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
