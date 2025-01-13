<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('recorded_at'); // Дата записи метрики
            $table->float('weight'); // Вес в килограммах
            $table->float('height')->nullable(); // Рост в сантиметрах
            $table->float('bmi')->nullable(); // Индекс массы тела
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_metrics');
    }
};
