<?php

namespace App\Filament\Resources\ClassCountingSheets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Filament\Schemas\Components\Section;

class ClassCountingSheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Class Counting Sheet ')
      ->columns(4)
      ->columnSpanFull()
      ->schema([
                DatePicker::make('date')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                Select::make('batch_id')
                    ->relationship('batch', 'name')
                    ->required(),
                Select::make('time_slot_id')
                    ->relationship('timeSlot', 'time')
                    ->getOptionLabelFromRecordUsing(
                        static fn ($record): string => Carbon::parse($record->time)->format('h:i A')
                    )
                    ->required(),
                TextInput::make('class_count')
                    ->required()
                    ->numeric(),
                TextInput::make('topic')
                    ->required(),
                Textarea::make('remark')
                    ->default(null)
                    ->columnSpanFull(),
            ])
    ]);
    }
}
