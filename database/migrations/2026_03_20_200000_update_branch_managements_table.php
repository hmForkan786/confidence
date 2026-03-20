<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branch_managements', function (Blueprint $table) {
            if (Schema::hasColumn('branch_managements', 'today_total_income')) {
                $table->dropColumn('today_total_income');
            }
            if (Schema::hasColumn('branch_managements', 'total_expense')) {
                $table->dropColumn('total_expense');
            }
            if (Schema::hasColumn('branch_managements', 'cash_in_hand')) {
                $table->dropColumn('cash_in_hand');
            }
            if (Schema::hasColumn('branch_managements', 'penalty_collected')) {
                $table->dropColumn('penalty_collected');
            }
            if (Schema::hasColumn('branch_managements', 'bank_deposit')) {
                $table->dropColumn('bank_deposit');
            }
            if (Schema::hasColumn('branch_managements', 'foundation_count')) {
                $table->dropColumn('foundation_count');
            }
            if (Schema::hasColumn('branch_managements', 'preli_count')) {
                $table->dropColumn('preli_count');
            }
            if (Schema::hasColumn('branch_managements', 'preli_online_count')) {
                $table->dropColumn('preli_online_count');
            }
            if (Schema::hasColumn('branch_managements', 'exam_count')) {
                $table->dropColumn('exam_count');
            }

            if (!Schema::hasColumn('branch_managements', 'today_bank_deposit')) {
                $table->decimal('today_bank_deposit', 12, 2)->default(0)->after('today_admission');
            }
            if (!Schema::hasColumn('branch_managements', 'penalty')) {
                $table->decimal('penalty', 12, 2)->nullable()->after('today_bank_deposit');
            }
            if (!Schema::hasColumn('branch_managements', 'remark')) {
                $table->text('remark')->nullable()->after('penalty');
            }
        });

        Schema::table('branch_managements', function (Blueprint $table) {
            $table->index(['branch_id', 'date'], 'branch_managements_branch_date_index');
        });
    }

    public function down(): void
    {
        Schema::table('branch_managements', function (Blueprint $table) {
            if (Schema::hasColumn('branch_managements', 'today_bank_deposit')) {
                $table->dropColumn('today_bank_deposit');
            }
            if (Schema::hasColumn('branch_managements', 'penalty')) {
                $table->dropColumn('penalty');
            }
            if (Schema::hasColumn('branch_managements', 'remark')) {
                $table->dropColumn('remark');
            }

            if (!Schema::hasColumn('branch_managements', 'today_total_income')) {
                $table->decimal('today_total_income', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'bank_deposit')) {
                $table->decimal('bank_deposit', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'total_expense')) {
                $table->decimal('total_expense', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'penalty_collected')) {
                $table->decimal('penalty_collected', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'cash_in_hand')) {
                $table->decimal('cash_in_hand', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'foundation_count')) {
                $table->unsignedInteger('foundation_count')->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'preli_count')) {
                $table->unsignedInteger('preli_count')->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'preli_online_count')) {
                $table->unsignedInteger('preli_online_count')->default(0);
            }
            if (!Schema::hasColumn('branch_managements', 'exam_count')) {
                $table->unsignedInteger('exam_count')->default(0);
            }
        });

        Schema::table('branch_managements', function (Blueprint $table) {
            $table->dropIndex('branch_managements_branch_date_index');
        });
    }
};
