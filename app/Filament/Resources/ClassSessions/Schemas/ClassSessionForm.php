<?php

namespace App\Filament\Resources\ClassSessions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ClassSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Select::make('batch_id')
                    ->relationship('batch', 'name')
                    ->required(),
                Select::make('time_slot_id')
                    ->relationship('timeSlot', 'id')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                TextInput::make('lecture_no')
                    ->required()
                    ->numeric(),
                DatePicker::make('class_date')
                    ->required(),
                TextInput::make('topic')
                    ->default(null),
                Textarea::make('remark')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
