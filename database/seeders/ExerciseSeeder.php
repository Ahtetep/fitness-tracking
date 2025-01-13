<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('exercises')->insert([
            ['name' => 'Отжимания', 'description' => 'Упражнение на грудные мышцы и трицепсы', 'type' => 'repetitions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Приседания', 'description' => 'Упражнение для ног', 'type' => 'repetitions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Планка', 'description' => 'Упражнение для кора', 'type' => 'time_distance_calories', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Орбитрек', 'description' => 'Кардио упражнение', 'type' => 'time_distance_calories', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
