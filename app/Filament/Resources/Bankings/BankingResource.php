<?php

namespace App\Filament\Resources\Bankings;

use App\Filament\Resources\Bankings\Pages\CreateBanking;
use App\Filament\Resources\Bankings\Pages\EditBanking;
use App\Filament\Resources\Bankings\Pages\ListBankings;
use App\Filament\Resources\Bankings\Pages\ViewBanking;
use App\Filament\Resources\Bankings\Schemas\BankingForm;
use App\Filament\Resources\Bankings\Schemas\BankingInfolist;
use App\Filament\Resources\Bankings\Tables\BankingsTable;
use App\Models\Banking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BankingResource extends Resource
{
    protected static ?string $model = Banking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Banking';

    public static function form(Schema $schema): Schema
    {
        return BankingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BankingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BankingsTable::configure($table);
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
            'index' => ListBankings::route('/'),
            'create' => CreateBanking::route('/create'),
            'view' => ViewBanking::route('/{record}'),
            'edit' => EditBanking::route('/{record}/edit'),
        ];
    }
}
