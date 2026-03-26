<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('daily_reportings', 'admission_items')) {
            Schema::table('daily_reportings', function (Blueprint $table) {
                $table->json('admission_items')->nullable()->after('admission');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('daily_reportings', 'admission_items')) {
            Schema::table('daily_reportings', function (Blueprint $table) {
                $table->dropColumn('admission_items');
            });
        }
    }
};
