<?php

namespace App\Filament\Resources\BranchManagement\Pages;

use App\Filament\Resources\BranchManagement\BranchManagementResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBranchManagement extends EditRecord
{
    protected static string $resource = BranchManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
