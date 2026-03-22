<?php

namespace App\Filament\Resources\Incomes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Income Session')
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('branch_id')
                            ->relationship('branch', 'name')
                            ->required(),
                        Select::make('source')
                            ->options(['admission' => 'Admission', 'form' => 'Form', 'penalty' => 'Penalty', 'book' => 'Book'])
                            ->required(),
                        TextInput::make('amount')
                            ->required()
                            ->numeric(),
                        DatePicker::make('date')
                            ->required(),
                        Textarea::make('entries')
                            ->default(null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
