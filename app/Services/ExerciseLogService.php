<?php

namespace App\Services;

use App\Models\ExerciseLog;
use Illuminate\Database\Eloquent\Collection;

class ExerciseLogService extends BaseService
{
    public function __construct(ExerciseLog $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить записи журнала по пользователю.
     *
     * @param int $userId
     * @return Collection<int, ExerciseLog> Записи журнала пользователя
     */
    public function getByUserId(int $userId): Collection
    {
        return ExerciseLog::whereUserId($userId)->get();
    }

    /**
     * Получить записи журнала по упражнению.
     *
     * @param int $exerciseId
     * @return Collection<int, ExerciseLog> Записи журнала упражнения
     */
    public function getByExerciseId(int $exerciseId): Collection
    {
        return ExerciseLog::whereExerciseId($exerciseId)->get();
    }

    /**
     * Получить записи журнала за определенный день.
     *
     * @param string $date
     * @return Collection<int, ExerciseLog> Записи за указанный день
     */
    public function getByDate(string $date): Collection
    {
        return ExerciseLog::whereLoggedAt($date)->get();
    }

    /**
     * Найти запись журнала по ID пользователя и ID упражнения.
     *
     * @param int $userId
     * @param int $exerciseId
     * @return ExerciseLog|null Запись журнала или null, если не найдено
     */
    public function findByUserAndExercise(int $userId, int $exerciseId): ?ExerciseLog
    {
        return ExerciseLog::whereUserId($userId)
            ->whereExerciseId($exerciseId)
            ->first();
    }
}
