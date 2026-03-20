<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('from_branch_roll')->nullable();
            $table->string('from_branch_mr_no')->nullable();
            $table->decimal('from_branch_amount', 12, 2)->nullable();
            $table->string('to_branch_roll')->nullable();
            $table->string('to_branch_mr_no')->nullable();
            $table->decimal('to_branch_amount', 12, 2)->nullable();
            $table->text('branch_remark')->nullable();

            $table->string('from_batch_old_roll')->nullable();
            $table->string('from_batch_old_mr_no')->nullable();
            $table->decimal('from_batch_old_amount', 12, 2)->nullable();
            $table->string('to_batch_new_roll')->nullable();
            $table->string('to_batch_new_mr_no')->nullable();
            $table->decimal('to_batch_new_amount', 12, 2)->nullable();
            $table->text('batch_remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->dropColumn([
                'from_branch_roll',
                'from_branch_mr_no',
                'from_branch_amount',
                'to_branch_roll',
                'to_branch_mr_no',
                'to_branch_amount',
                'branch_remark',
                'from_batch_old_roll',
                'from_batch_old_mr_no',
                'from_batch_old_amount',
                'to_batch_new_roll',
                'to_batch_new_mr_no',
                'to_batch_new_amount',
                'batch_remark',
            ]);
        });
    }
};
