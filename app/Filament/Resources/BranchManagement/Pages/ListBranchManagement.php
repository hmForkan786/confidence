<?php

namespace App\Filament\Resources\BranchManagement\Pages;

use App\Filament\Resources\BranchManagement\BranchManagementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBranchManagement extends ListRecords
{
    protected static string $resource = BranchManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
