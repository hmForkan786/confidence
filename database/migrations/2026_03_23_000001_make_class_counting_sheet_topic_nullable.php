<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE class_counting_sheets MODIFY topic VARCHAR(255) NULL');
            return;
        }

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE class_counting_sheets ALTER COLUMN topic DROP NOT NULL');
            return;
        }

        // SQLite column alteration without DBAL is non-trivial; skip.
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE class_counting_sheets MODIFY topic VARCHAR(255) NOT NULL');
            return;
        }

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE class_counting_sheets ALTER COLUMN topic SET NOT NULL');
            return;
        }

        // SQLite column alteration without DBAL is non-trivial; skip.
    }
};
