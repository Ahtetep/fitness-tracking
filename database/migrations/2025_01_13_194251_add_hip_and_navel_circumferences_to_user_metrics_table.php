<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHipAndNavelCircumferencesToUserMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->float('hip_circumference')->nullable()->after('waist_circumference')->comment('Окружность попы');
            $table->float('navel_circumference')->nullable()->after('hip_circumference')->comment('Окружность по пупку');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->dropColumn('hip_circumference');
            $table->dropColumn('navel_circumference');
        });
    }
}
