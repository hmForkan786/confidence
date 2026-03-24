<?php

namespace App\Filament\Resources\DailyReportings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class DailyReportingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Daily Reporting')
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema([
                        DatePicker::make('date')
                            ->required()
                            ->default(today()),
                        Select::make('branch_id')
                            ->relationship('branch', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Repeater::make('admission_items')
                            ->label('Admission')
                            ->schema([
                                Select::make('batch_id')
                                    ->label('Batch')
                                    ->options(fn () => DB::table('batches')->orderBy('name')->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                TextInput::make('amount')
                                    ->label('Admission')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        Placeholder::make('total_admission')
                            ->label('Total Admission')
                            ->content(function (Get $get) {
                                $items = $get('admission_items') ?? [];
                                $total = collect($items)->sum(fn ($item) => (float) ($item['amount'] ?? 0));

                                return number_format($total, 2);
                            }),
                        TextInput::make('opening_balance')
                            ->label('Opening Balance')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        TextInput::make('bank_deposit_amount')
                            ->label('Bank Deposit Amount')
                            ->numeric()
                            ->default(0),
                        Repeater::make('income_items')
                            ->label('Income')
                            ->schema([
                                Select::make('income_id')
                                    ->label('Income')
                                    ->options(fn () => DB::table('incomes')->orderBy('name')->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                TextInput::make('amount')
                                    ->label('Amount')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        Placeholder::make('total_income')
                            ->label('Total Income')
                            ->content(function (Get $get) {
                                $items = $get('income_items') ?? [];
                                $total = collect($items)->sum(fn ($item) => (float) ($item['amount'] ?? 0));

                                return number_format($total, 2);
                            }),
                        Repeater::make('expense_items')
                            ->label('Expense')
                            ->schema([
                                Select::make('expense_id')
                                    ->label('Expense')
                                    ->options(fn () => DB::table('expenses')->orderBy('name')->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                TextInput::make('amount')
                                    ->label('Amount')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        Placeholder::make('total_expense')
                            ->label('Total Expense')
                            ->content(function (Get $get) {
                                $items = $get('expense_items') ?? [];
                                $total = collect($items)->sum(fn ($item) => (float) ($item['amount'] ?? 0));

                                return number_format($total, 2);
                            }),
                        FileUpload::make('receipt_image')
                            ->label('Receipt (Image)')
                            ->image()
                            ->directory('daily-reportings/receipts')
                            ->imagePreviewHeight(120)
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('bank_deposit_slip')
                            ->label('Bank Deposit Slip (Image)')
                            ->image()
                            ->directory('daily-reportings/bank-slips')
                            ->imagePreviewHeight(120)
                            ->downloadable()
                            ->openable(),
                        TextInput::make('cash_in_hand')
                            ->label('Cash in Hand')
                            ->numeric()
                            ->default(0),
                        Placeholder::make('calculated_cash_in_hand')
                            ->label('Calculated Cash in Hand')
                            ->content(function (Get $get) {
                                $opening = (float) ($get('opening_balance') ?? 0);
                                $bankDeposit = (float) ($get('bank_deposit_amount') ?? 0);
                                $admissionItems = $get('admission_items') ?? [];
                                $incomeItems = $get('income_items') ?? [];
                                $expenseItems = $get('expense_items') ?? [];
                                $admissionTotal = collect($admissionItems)->sum(fn ($item) => (float) ($item['amount'] ?? 0));
                                $incomeTotal = collect($incomeItems)->sum(fn ($item) => (float) ($item['amount'] ?? 0));
                                $expenseTotal = collect($expenseItems)->sum(fn ($item) => (float) ($item['amount'] ?? 0));

                                return number_format($opening + $admissionTotal + $incomeTotal - $expenseTotal - $bankDeposit, 2);
                            }),
                    ]),
            ]);
    }
}
