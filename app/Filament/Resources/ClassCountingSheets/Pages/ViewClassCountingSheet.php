<?php

namespace App\Filament\Resources\ClassCountingSheets\Pages;

use App\Filament\Resources\ClassCountingSheets\ClassCountingSheetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClassCountingSheet extends ViewRecord
{
    protected static string $resource = ClassCountingSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
