<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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
                Select::make('source')
                    ->options(['teacher_rent' => 'Teacher rent', 'other' => 'Other'])
                    ->required(),
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
                Textarea::make('entries')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
