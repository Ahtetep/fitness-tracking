<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercise_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->integer('repetitions')->nullable(); // Для упражнений с повторениями
            $table->integer('time')->nullable(); // Время в минутах для кардио
            $table->float('distance')->nullable(); // Расстояние в километрах
            $table->integer('calories')->nullable(); // Потраченные калории
            $table->timestamp('logged_at'); // Время выполнения
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercise_logs');
    }
};
