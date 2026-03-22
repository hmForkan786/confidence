<?php

namespace App\Filament\Resources\Transfers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Transfer form (Branch to Branch)')
                    ->schema([
                        Select::make('from_branch_id')
                            ->relationship('fromBranch', 'name')
                            ->required(),
                        Select::make('to_branch_id')
                            ->relationship('toBranch', 'name')
                            ->required(),
                        TextInput::make('from_branch_roll')
                            ->label('From branch roll no')
                            ->required(),
                        TextInput::make('from_branch_mr_no')
                            ->label('From branch MR no')
                            ->required(),
                        TextInput::make('from_branch_amount')
                            ->label('From branch amount')
                            ->required()
                            ->numeric(),
                        TextInput::make('to_branch_roll')
                            ->label('To branch roll no')
                            ->required(),
                        TextInput::make('to_branch_mr_no')
                            ->label('To branch MR no')
                            ->required(),
                        TextInput::make('to_branch_amount')
                            ->label('To branch amount')
                            ->required()
                            ->numeric(),
                        Textarea::make('branch_remark')
                            ->label('Remark')
                            ->default(null)
                            ->columnSpanFull(),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
                Section::make('Transfer form (Batch to Batch)')
                    ->schema([
                        Select::make('from_batch_id')
                            ->relationship('fromBatch', 'name')
                            ->required(),
                        Select::make('to_batch_id')
                            ->relationship('toBatch', 'name')
                            ->required(),
                        TextInput::make('from_batch_old_roll')
                            ->label('From batch old roll no')
                            ->required(),
                        TextInput::make('from_batch_old_mr_no')
                            ->label('From batch old MR no')
                            ->required(),
                        TextInput::make('from_batch_old_amount')
                            ->label('From batch old amount')
                            ->required()
                            ->numeric(),
                        TextInput::make('to_batch_new_roll')
                            ->label('To batch new roll no')
                            ->required(),
                        TextInput::make('to_batch_new_mr_no')
                            ->label('To batch new MR no')
                            ->required(),
                        TextInput::make('to_batch_new_amount')
                            ->label('To batch new amount')
                            ->required()
                            ->numeric(),
                        Textarea::make('batch_remark')
                            ->label('Remark')
                            ->default(null)
                            ->columnSpanFull(),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
