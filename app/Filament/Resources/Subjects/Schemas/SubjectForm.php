<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subject Session')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                    ]),
            ]);
    }
}
