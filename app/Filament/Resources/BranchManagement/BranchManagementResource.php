<?php

namespace App\Filament\Resources\BranchManagement;

use App\Filament\Resources\BranchManagement\Pages\CreateBranchManagement;
use App\Filament\Resources\BranchManagement\Pages\EditBranchManagement;
use App\Filament\Resources\BranchManagement\Pages\ListBranchManagement;
use App\Filament\Resources\BranchManagement\Pages\ViewBranchManagement;
use App\Filament\Resources\BranchManagement\Schemas\BranchManagementForm;
use App\Filament\Resources\BranchManagement\Schemas\BranchManagementInfolist;
use App\Filament\Resources\BranchManagement\Tables\BranchManagementTable;
use App\Models\BranchManagement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BranchManagementResource extends Resource
{
    protected static ?string $model = BranchManagement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'BranchManagement';

    public static function form(Schema $schema): Schema
    {
        return BranchManagementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BranchManagementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BranchManagementTable::configure($table);
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
            'index' => ListBranchManagement::route('/'),
            'create' => CreateBranchManagement::route('/create'),
            'view' => ViewBranchManagement::route('/{record}'),
            'edit' => EditBranchManagement::route('/{record}/edit'),
        ];
    }
}
