<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_counting_sheets', function (Blueprint $table) {
            if (!Schema::hasColumn('class_counting_sheets', 'time_slot_ids')) {
                $table->json('time_slot_ids')->nullable()->after('time_slot_id');
            }

            $table->foreignId('time_slot_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('class_counting_sheets', function (Blueprint $table) {
            if (Schema::hasColumn('class_counting_sheets', 'time_slot_ids')) {
                $table->dropColumn('time_slot_ids');
            }

            $table->foreignId('time_slot_id')->nullable(false)->change();
        });
    }
};
