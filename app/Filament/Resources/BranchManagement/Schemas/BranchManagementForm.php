<?php

namespace App\Filament\Resources\BranchManagement\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BranchManagementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('today_admission')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('opening_balance')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('today_total_income')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('bank_deposit')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_expense')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('penalty_collected')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('cash_in_hand')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('foundation_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('preli_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('preli_online_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('exam_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
