<?php

namespace App\Filament\Resources\Transfers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransferInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Section One')
                    ->schema([
                        TextEntry::make('fromBranch.name')
                            ->label('From branch'),
                        TextEntry::make('toBranch.name')
                            ->label('To branch'),
                        TextEntry::make('from_branch_roll')
                            ->label('From branch roll no'),
                        TextEntry::make('from_branch_mr_no')
                            ->label('From branch MR no'),
                        TextEntry::make('from_branch_amount')
                            ->label('From branch amount')
                            ->numeric(),
                        TextEntry::make('to_branch_roll')
                            ->label('To branch roll no'),
                        TextEntry::make('to_branch_mr_no')
                            ->label('To branch MR no'),
                        TextEntry::make('to_branch_amount')
                            ->label('To branch amount')
                            ->numeric(),
                        TextEntry::make('branch_remark')
                            ->label('Remark')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                Section::make('Section Two')
                    ->schema([
                        TextEntry::make('fromBatch.name')
                            ->label('From batch'),
                        TextEntry::make('toBatch.name')
                            ->label('To batch'),
                        TextEntry::make('from_batch_old_roll')
                            ->label('From batch old roll no'),
                        TextEntry::make('from_batch_old_mr_no')
                            ->label('From batch old MR no'),
                        TextEntry::make('from_batch_old_amount')
                            ->label('From batch old amount')
                            ->numeric(),
                        TextEntry::make('to_batch_new_roll')
                            ->label('To batch new roll no'),
                        TextEntry::make('to_batch_new_mr_no')
                            ->label('To batch new MR no'),
                        TextEntry::make('to_batch_new_amount')
                            ->label('To batch new amount')
                            ->numeric(),
                        TextEntry::make('batch_remark')
                            ->label('Remark')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
