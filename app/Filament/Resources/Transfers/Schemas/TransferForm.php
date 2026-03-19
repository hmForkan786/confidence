<?php

namespace App\Filament\Resources\Transfers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('from_branch_id')
                    ->relationship('fromBranch', 'name')
                    ->required(),
                Select::make('to_branch_id')
                    ->relationship('toBranch', 'name')
                    ->required(),
                Select::make('from_batch_id')
                    ->relationship('fromBatch', 'name')
                    ->required(),
                Select::make('to_batch_id')
                    ->relationship('toBatch', 'name')
                    ->required(),
                TextInput::make('old_roll')
                    ->required(),
                TextInput::make('new_roll')
                    ->required(),
                TextInput::make('old_mr_no')
                    ->required(),
                TextInput::make('new_mr_no')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Textarea::make('remark')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
