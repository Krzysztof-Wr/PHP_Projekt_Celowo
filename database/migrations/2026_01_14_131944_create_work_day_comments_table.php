<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_day_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('work_day_id')->constrained('work_days')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // kto komentuje
            $table->text('body');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_day_comments');
    }
};
