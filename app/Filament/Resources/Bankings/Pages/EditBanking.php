<?php

namespace App\Filament\Resources\Bankings\Pages;

use App\Filament\Resources\Bankings\BankingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBanking extends EditRecord
{
    protected static string $resource = BankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
