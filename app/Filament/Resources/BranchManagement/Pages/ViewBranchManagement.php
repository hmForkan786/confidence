<?php

namespace App\Filament\Resources\BranchManagement\Pages;

use App\Filament\Resources\BranchManagement\BranchManagementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBranchManagement extends ViewRecord
{
    protected static string $resource = BranchManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
