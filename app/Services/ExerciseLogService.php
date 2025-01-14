<?php

namespace App\Services;

use App\Models\ExerciseLog;
use Illuminate\Support\Collection;

class ExerciseLogService
{
    /**
     * Создать запись в журнале упражнений.
     *
     * @param array $data
     * @return ExerciseLog
     */
    public function createExerciseLog(array $data): ExerciseLog
    {
        return ExerciseLog::create($data);
    }

    /**
     * Получить данные для графиков по упражнению.
     *
     * @param int $exerciseId
     * @param string $startDate
     * @param string $endDate
     * @param int $userId
     * @return Collection
     */
    public function getLogsByExercise($exerciseId, $startDate, $endDate, $userId): Collection
    {
        return ExerciseLog::selectRaw('logged_at as date, SUM(repetitions) as total_repetitions, SUM(time) as total_time, SUM(distance) as total_distance, SUM(calories) as total_calories')
            ->where('exercise_id', $exerciseId)
            ->where('user_id', $userId)
            ->whereBetween('logged_at', [$startDate, $endDate])
            ->groupBy('logged_at')
            ->orderBy('logged_at')
            ->get();
    }
}
