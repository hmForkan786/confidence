<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('batches', 'admission_items')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->json('admission_items')->nullable()->after('type');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('batches', 'admission_items')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->dropColumn('admission_items');
            });
        }
    }
};
