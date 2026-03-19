<?php

namespace App\Filament\Resources\Bankings\Pages;

use App\Filament\Resources\Bankings\BankingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBanking extends ViewRecord
{
    protected static string $resource = BankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
