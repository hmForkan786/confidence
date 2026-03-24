<?php

namespace App\Filament\Resources\DailyReportings\Schemas;

use App\Models\DailyReporting;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DailyReportingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('branch.name')
                    ->label('Branch'),
                TextEntry::make('batch.name')
                    ->label('Batch'),
                TextEntry::make('admission')
                    ->numeric(),
                TextEntry::make('opening_balance')
                    ->label('Opening Balance')
                    ->numeric(),
                TextEntry::make('total_income')
                    ->label('Total Income')
                    ->state(fn (DailyReporting $record) => $record->total_income)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2)),
                TextEntry::make('total_expense')
                    ->label('Total Expense')
                    ->state(fn (DailyReporting $record) => $record->total_expense)
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 2)),
                TextEntry::make('bank_deposit_amount')
                    ->label('Bank Deposit Amount')
                    ->numeric(),
                TextEntry::make('cash_in_hand')
                    ->label('Cash in Hand')
                    ->numeric(),
                ImageEntry::make('receipt_image')
                    ->label('Receipt')
                    ->placeholder('-'),
                ImageEntry::make('bank_deposit_slip')
                    ->label('Bank Deposit Slip')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
