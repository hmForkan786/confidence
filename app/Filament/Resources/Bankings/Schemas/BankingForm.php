<?php

namespace App\Filament\Resources\Bankings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BankingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banking')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('bank_title')
                            ->required(),
                        TextInput::make('bank_name')
                            ->required(),
                        TextInput::make('account_no')
                            ->required(),
                        Textarea::make('remark')
                            ->default(null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
