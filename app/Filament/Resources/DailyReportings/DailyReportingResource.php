<?php

namespace App\Filament\Resources\DailyReportings;

use App\Filament\Resources\DailyReportings\Pages\CreateDailyReporting;
use App\Filament\Resources\DailyReportings\Pages\EditDailyReporting;
use App\Filament\Resources\DailyReportings\Pages\ListDailyReportings;
use App\Filament\Resources\DailyReportings\Pages\ViewDailyReporting;
use App\Filament\Resources\DailyReportings\Schemas\DailyReportingForm;
use App\Filament\Resources\DailyReportings\Schemas\DailyReportingInfolist;
use App\Filament\Resources\DailyReportings\Tables\DailyReportingsTable;
use App\Models\DailyReporting;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DailyReportingResource extends Resource
{
    protected static ?string $model = DailyReporting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Create Report';

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Schema $schema): Schema
    {
        return DailyReportingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DailyReportingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DailyReportingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDailyReportings::route('/'),
            'create' => CreateDailyReporting::route('/create'),
            'view' => ViewDailyReporting::route('/{record}'),
            'edit' => EditDailyReporting::route('/{record}/edit'),
        ];
    }
}


