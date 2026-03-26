<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_counting_sheets', function (Blueprint $table) {
            if (!Schema::hasColumn('class_counting_sheets', 'group_key')) {
                $table->uuid('group_key')->nullable()->after('id')->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('class_counting_sheets', function (Blueprint $table) {
            if (Schema::hasColumn('class_counting_sheets', 'group_key')) {
                $table->dropColumn('group_key');
            }
        });
    }
};
