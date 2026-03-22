<?php

namespace App\Filament\Resources\TimeSlots\Schemas;

use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TimeSlotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Time Slot Session')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TimePicker::make('time')
                            ->seconds(false)
                            ->displayFormat('h:i A')
                            ->required(),
                    ]),
            ]);
    }
}
