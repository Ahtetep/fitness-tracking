<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChestAndWaistToUserMetricsTable extends Migration
{
    public function up(): void
    {
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->float('chest_circumference')->nullable()->after('bmi'); // Обхват груди
            $table->float('waist_circumference')->nullable()->after('chest_circumference'); // Обхват талии
        });
    }

    public function down(): void
    {
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->dropColumn(['chest_circumference', 'waist_circumference']);
        });
    }
}
