<?php

namespace App\Filament\Resources\Transfers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('transfer_type')
                    ->label('Transfer Type')
                    ->options([
                        'branch_to_branch' => 'Branch to Branch',
                        'batch_to_batch' => 'Batch to Batch',
                    ])
                    ->default('branch_to_branch')
                    ->required()
                    ->live()
                    ->columnSpanFull(),
                Section::make('Transfer form (Branch to Branch)')
                    ->visible(fn (Get $get) => $get('transfer_type') === 'branch_to_branch')
                    ->schema([
                        Select::make('from_branch_id')
                            ->relationship('fromBranch', 'name')
                            ->required(),
                        Select::make('to_branch_id')
                            ->relationship('toBranch', 'name')
                            ->required(),
                        TextInput::make('from_branch_roll')
                            ->label('From branch roll no'),
                        TextInput::make('from_branch_mr_no')
                            ->label('From branch MR no'),
                        TextInput::make('from_branch_amount')
                            ->label('From branch amount')
                            ->required()
                            ->numeric(),
                        TextInput::make('to_branch_roll')
                            ->label('To branch roll no'),
                        TextInput::make('to_branch_mr_no')
                            ->label('To branch MR no'),
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
                    ->visible(fn (Get $get) => $get('transfer_type') === 'batch_to_batch')
                    ->schema([
                        Select::make('from_batch_id')
                            ->relationship('fromBatch', 'name')
                            ->required(),
                        Select::make('to_batch_id')
                            ->relationship('toBatch', 'name')
                            ->required(),
                        TextInput::make('from_batch_old_roll')
                            ->label('From batch old roll no'),
                        TextInput::make('from_batch_old_mr_no')
                            ->label('From batch old MR no'),
                        TextInput::make('from_batch_old_amount')
                            ->label('From batch old amount')
                            ->required()
                            ->numeric(),
                        TextInput::make('to_batch_new_roll')
                            ->label('To batch new roll no'),
                        TextInput::make('to_batch_new_mr_no')
                            ->label('To batch new MR no'),
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
