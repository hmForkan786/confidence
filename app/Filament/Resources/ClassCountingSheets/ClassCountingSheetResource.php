<?php

namespace App\Filament\Resources\ClassCountingSheets;

use App\Filament\Resources\ClassCountingSheets\Pages\CreateClassCountingSheet;
use App\Filament\Resources\ClassCountingSheets\Pages\EditClassCountingSheet;
use App\Filament\Resources\ClassCountingSheets\Pages\ListClassCountingSheets;
use App\Filament\Resources\ClassCountingSheets\Pages\ViewClassCountingSheet;
use App\Filament\Resources\ClassCountingSheets\Schemas\ClassCountingSheetForm;
use App\Filament\Resources\ClassCountingSheets\Schemas\ClassCountingSheetInfolist;
use App\Filament\Resources\ClassCountingSheets\Tables\ClassCountingSheetsTable;
use App\Models\ClassCountingSheet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClassCountingSheetResource extends Resource
{
    protected static ?string $model = ClassCountingSheet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ClassCountingSheet';

    public static function form(Schema $schema): Schema
    {
        return ClassCountingSheetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClassCountingSheetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassCountingSheetsTable::configure($table);
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
            'index' => ListClassCountingSheets::route('/'),
            'create' => CreateClassCountingSheet::route('/create'),
            'view' => ViewClassCountingSheet::route('/{record}'),
            'edit' => EditClassCountingSheet::route('/{record}/edit'),
        ];
    }
}
