<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                Hidden::make('source')
                    ->default('other'),
                Repeater::make('entries')
                    ->label('Source')
                    ->schema([
                        TextInput::make('source')
                            ->required(),
                    ])
                    ->defaultItems(1)
                    ->columnSpanFull(),
                TextInput::make('category')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                FileUpload::make('receipt_image')
                    ->image()
                    ->required(),
                Textarea::make('remark')
                    ->default(null)
                    ->columnSpanFull(),
                DatePicker::make('date')
                    ->required(),
            ]);
    }
}
