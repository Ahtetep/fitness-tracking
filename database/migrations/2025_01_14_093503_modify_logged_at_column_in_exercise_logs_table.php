<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLoggedAtColumnInExerciseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exercise_logs', function (Blueprint $table) {
            // Создаём временный столбец с типом DATE
            $table->date('logged_at_temp')->nullable();
        });

        // Копируем данные из старого столбца в новый
        DB::statement('UPDATE exercise_logs SET logged_at_temp = DATE(logged_at)');

        Schema::table('exercise_logs', function (Blueprint $table) {
            // Удаляем старый столбец
            $table->dropColumn('logged_at');
        });

        Schema::table('exercise_logs', function (Blueprint $table) {
            // Переименовываем временный столбец
            $table->renameColumn('logged_at_temp', 'logged_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exercise_logs', function (Blueprint $table) {
            // Создаём временный столбец с типом DATETIME
            $table->dateTime('logged_at_temp')->nullable();
        });

        // Копируем данные из нового столбца обратно в старый
        DB::statement('UPDATE exercise_logs SET logged_at_temp = logged_at');

        Schema::table('exercise_logs', function (Blueprint $table) {
            // Удаляем новый столбец
            $table->dropColumn('logged_at');
        });

        Schema::table('exercise_logs', function (Blueprint $table) {
            // Переименовываем временный столбец
            $table->renameColumn('logged_at_temp', 'logged_at');
        });
    }
}
