<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_reportings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('admission')->default(0);
            $table->decimal('opening_balance', 12, 2)->default(0);
            $table->json('income_items')->nullable();
            $table->json('expense_items')->nullable();
            $table->string('receipt_image')->nullable();
            $table->decimal('bank_deposit_amount', 12, 2)->default(0);
            $table->string('bank_deposit_slip')->nullable();
            $table->decimal('cash_in_hand', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reportings');
    }
};
