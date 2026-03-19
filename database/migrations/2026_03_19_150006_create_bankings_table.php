<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bankings', function (Blueprint $table) {
            $table->id();
            $table->string('bank_title');
            $table->string('bank_name');
            $table->string('account_no');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bankings');
    }
};
