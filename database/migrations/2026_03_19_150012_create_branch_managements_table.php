<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->unsignedInteger('today_admission')->default(0);
            $table->decimal('opening_balance', 12, 2)->default(0);
            $table->decimal('today_total_income', 12, 2)->default(0);
            $table->decimal('bank_deposit', 12, 2)->default(0);
            $table->decimal('total_expense', 12, 2)->default(0);
            $table->decimal('penalty_collected', 12, 2)->default(0);
            $table->decimal('cash_in_hand', 12, 2)->default(0);
            $table->unsignedInteger('foundation_count')->default(0);
            $table->unsignedInteger('preli_count')->default(0);
            $table->unsignedInteger('preli_online_count')->default(0);
            $table->unsignedInteger('exam_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_managements');
    }
};
