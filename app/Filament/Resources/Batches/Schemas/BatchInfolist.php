<?php

namespace App\Filament\Resources\Batches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BatchInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('total_class')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(function (?string $state): ?string {
                        if ($state === null) {
                            return null;
                        }

                        return [
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ][$state] ?? $state;
                    }),
                TextEntry::make('type')
                    ->badge()
                    ->formatStateUsing(function (?string $state): ?string {
                        if ($state === null) {
                            return null;
                        }

                        return [
                            'offline_exam' => 'Offline exam',
                            'offline_regular' => 'Offline regular',
                            'online_regular' => 'Online regular',
                            'online_exam' => 'Online exam',
                            'offline_online' => 'Offline+Online',
                        ][$state] ?? $state;
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
