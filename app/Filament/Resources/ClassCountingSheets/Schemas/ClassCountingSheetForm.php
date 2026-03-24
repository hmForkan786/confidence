<?php

namespace App\Filament\Resources\ClassCountingSheets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
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
                    ->default(today())
                    ->required(),
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                Repeater::make('lecture_items')
                    ->label('Batch & Other')
                    ->schema([
                        Select::make('batch_id')
                            ->relationship('batch', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('teacher_id')
                            ->relationship('teacher', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('time_slot_id')
                            ->relationship('timeSlot', 'time')
                            ->getOptionLabelFromRecordUsing(
                                static fn ($record): string => Carbon::parse($record->time)->format('h:i A')
                            )
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('lecture')
                            ->nullable(),
                        TextInput::make('class_count')
                            ->label('Class Count')
                            ->required()
                            ->numeric(),
                    ])
                    ->columns(3)
                    ->defaultItems(0)
                    ->columnSpanFull(),
                Placeholder::make('total_class')
                    ->label('Total Class')
                    ->content(function (Get $get) {
                        $items = $get('lecture_items') ?? [];
                        $total = collect($items)->sum(fn ($item) => (float) ($item['class_count'] ?? 0));

                        return number_format($total, 0);
                    }),
                Textarea::make('remark')
                    ->default(null)
                    ->columnSpanFull(),
            ])
    ]);
    }
}
