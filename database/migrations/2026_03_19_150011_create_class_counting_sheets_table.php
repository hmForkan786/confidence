<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_counting_sheets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('time_slot_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('class_count');
            $table->string('topic');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_counting_sheets');
    }
};
