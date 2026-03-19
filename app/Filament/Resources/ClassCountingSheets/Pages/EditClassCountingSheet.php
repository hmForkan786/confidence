<?php

namespace App\Filament\Resources\ClassCountingSheets\Pages;

use App\Filament\Resources\ClassCountingSheets\ClassCountingSheetResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditClassCountingSheet extends EditRecord
{
    protected static string $resource = ClassCountingSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
