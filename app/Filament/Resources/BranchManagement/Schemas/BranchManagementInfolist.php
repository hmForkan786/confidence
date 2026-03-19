<?php

namespace App\Filament\Resources\BranchManagement\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BranchManagementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('today_admission')
                    ->numeric(),
                TextEntry::make('opening_balance')
                    ->numeric(),
                TextEntry::make('today_total_income')
                    ->numeric(),
                TextEntry::make('bank_deposit')
                    ->numeric(),
                TextEntry::make('total_expense')
                    ->numeric(),
                TextEntry::make('penalty_collected')
                    ->numeric(),
                TextEntry::make('cash_in_hand')
                    ->numeric(),
                TextEntry::make('foundation_count')
                    ->numeric(),
                TextEntry::make('preli_count')
                    ->numeric(),
                TextEntry::make('preli_online_count')
                    ->numeric(),
                TextEntry::make('exam_count')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
