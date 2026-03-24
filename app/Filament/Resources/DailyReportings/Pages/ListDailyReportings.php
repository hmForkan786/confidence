<?php

namespace App\Filament\Resources\DailyReportings\Pages;

use App\Filament\Resources\DailyReportings\DailyReportingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDailyReportings extends ListRecords
{
    protected static string $resource = DailyReportingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
