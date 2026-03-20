<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement(
                "ALTER TABLE `batches` MODIFY COLUMN `type` ENUM('offline_exam','offline_regular','online_regular','online_exam','offline_online')"
            );
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement(
                "ALTER TABLE `batches` MODIFY COLUMN `type` ENUM('offline_exam','offline_regular','online_regular','online_exam')"
            );
        }
    }
};
