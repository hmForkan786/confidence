<?php

namespace App\Filament\Resources\Bankings\Pages;

use App\Filament\Resources\Bankings\BankingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBankings extends ListRecords
{
    protected static string $resource = BankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
