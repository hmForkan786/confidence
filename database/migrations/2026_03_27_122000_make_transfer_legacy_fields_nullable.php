<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('old_roll')->nullable()->change();
            $table->string('new_roll')->nullable()->change();
            $table->string('old_mr_no')->nullable()->change();
            $table->string('new_mr_no')->nullable()->change();
            $table->decimal('amount', 12, 2)->nullable()->change();
            $table->text('remark')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('old_roll')->nullable(false)->change();
            $table->string('new_roll')->nullable(false)->change();
            $table->string('old_mr_no')->nullable(false)->change();
            $table->string('new_mr_no')->nullable(false)->change();
            $table->decimal('amount', 12, 2)->nullable(false)->change();
            $table->text('remark')->nullable(false)->change();
        });
    }
};
