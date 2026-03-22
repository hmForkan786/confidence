<?php

namespace App\Filament\Resources\BranchManagement\Schemas;

use App\Models\BranchManagement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class BranchManagementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Branch Management')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('branch_id')
                            ->relationship('branch', 'name')
                            ->required()
                            ->live(),
                        DatePicker::make('date')
                            ->required()
                            ->live(),
                        TextInput::make('opening_balance')
                            ->label('Opening Balance')
                            ->required()
                            ->numeric()
                            ->default(0.0)
                            ->live(),
                        TextInput::make('today_admission')
                            ->label('Today Admission')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('today_bank_deposit')
                            ->label('Today Bank Deposit')
                            ->required()
                            ->numeric()
                            ->default(0.0)
                            ->live(),
                        TextInput::make('penalty')
                            ->label('Penalty')
                            ->numeric()
                            ->default(0.0)
                            ->live(),
                        Textarea::make('remark')
                            ->label('Remark')
                            ->rows(3),
                        Placeholder::make('today_income')
                            ->label('Today Income')
                            ->content(fn (Get $get) => number_format(
                                BranchManagement::calculateTodayIncome($get('branch_id'), $get('date')),
                                2
                            )),
                        Placeholder::make('today_expense')
                            ->label('Today Expense')
                            ->content(fn (Get $get) => number_format(
                                BranchManagement::calculateTodayExpense($get('branch_id'), $get('date')),
                                2
                            )),
                        Placeholder::make('cash_in_hand')
                            ->label('Cash in Hand')
                            ->content(function (Get $get) {
                                $opening = (float) ($get('opening_balance') ?? 0);
                                $income = BranchManagement::calculateTodayIncome($get('branch_id'), $get('date'));
                                $penalty = (float) ($get('penalty') ?? 0);
                                $expense = BranchManagement::calculateTodayExpense($get('branch_id'), $get('date'));
                                $bankDeposit = (float) ($get('today_bank_deposit') ?? 0);

                                return number_format($opening + $income + $penalty - $expense - $bankDeposit, 2);
                            }),
                        Placeholder::make('batch_student_summaries')
                            ->label('Batch Student Summary')
                            ->content(fn () => BranchManagement::getBatchStudentSummaryText()),
                    ]),
            ]);
    }
}
