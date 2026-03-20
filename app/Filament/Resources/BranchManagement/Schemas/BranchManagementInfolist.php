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
                    ->label('Today Admission')
                    ->numeric(),
                TextEntry::make('opening_balance')
                    ->label('Opening Balance')
                    ->numeric(),
                TextEntry::make('today_income')
                    ->label('Today Income')
                    ->numeric(),
                TextEntry::make('today_expense')
                    ->label('Today Expense')
                    ->numeric(),
                TextEntry::make('today_bank_deposit')
                    ->label('Today Bank Deposit')
                    ->numeric(),
                TextEntry::make('penalty')
                    ->label('Penalty')
                    ->numeric(),
                TextEntry::make('cash_in_hand')
                    ->label('Cash in Hand')
                    ->numeric(),
                TextEntry::make('remark')
                    ->label('Remark')
                    ->placeholder('-'),
                TextEntry::make('batch_student_summaries_text')
                    ->label('Batch Student Summary')
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
