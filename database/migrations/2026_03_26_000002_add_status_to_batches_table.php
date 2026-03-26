<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('batches', 'status')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('total_class');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('batches', 'status')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
