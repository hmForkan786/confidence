<?php

namespace App\Filament\Resources\Batches\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('total_class')
                    ->required()
                    ->numeric(),
                TextInput::make('duration')
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
            ]);
    }
}
