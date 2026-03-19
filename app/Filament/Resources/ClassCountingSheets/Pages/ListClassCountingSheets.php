<?php

namespace App\Filament\Resources\ClassCountingSheets\Pages;

use App\Filament\Resources\ClassCountingSheets\ClassCountingSheetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClassCountingSheets extends ListRecords
{
    protected static string $resource = ClassCountingSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
