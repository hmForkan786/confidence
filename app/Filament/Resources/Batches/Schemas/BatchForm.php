<?php

namespace App\Filament\Resources\Batches\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class BatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Batch')
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('total_class')
                            ->required()
                            ->numeric(),
                        Select::make('status')
                            ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                            ->default('active')
                            ->required(),
                        Select::make('type')
                            ->options([
                                'offline_exam' => 'Offline exam',
                                'offline_regular' => 'Offline regular',
                                'online_regular' => 'Online regular',
                                'online_exam' => 'Online exam',
                                'offline_online' => 'Offline+Online',
                            ])
                            ->required(),
                        Repeater::make('admission_items')
                            ->label('Admission')
                            ->schema([
                                TextInput::make('count')
                                    ->label('Student Count')
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        Placeholder::make('total_admission')
                            ->label('Total Admission')
                            ->content(function (Get $get) {
                                $items = $get('admission_items') ?? [];
                                $total = collect($items)->sum(fn ($item) => (float) ($item['count'] ?? 0));

                                return number_format($total, 0);
                            }),
                    ]),
            ]);
    }
}
