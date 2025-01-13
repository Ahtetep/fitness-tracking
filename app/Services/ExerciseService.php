<?php

namespace App\Services;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Collection;

class ExerciseService extends BaseService
{
    public function __construct(Exercise $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить упражнения по типу.
     *
     * @param string $type
     * @return Collection<int, Exercise> Упражнения заданного типа
     */
    public function getByType(string $type): Collection
    {
        return Exercise::whereType($type)->get();
    }

    /**
     * Найти упражнение по имени.
     *
     * @param string $name
     * @return Exercise|null Упражнение или null, если не найдено
     */
    public function findByName(string $name): ?Exercise
    {
        return Exercise::whereName($name)->first();
    }

    /**
     * Получить последние упражнения.
     *
     * @param int $limit
     * @return Collection<int, Exercise>
     */
    public function getLatest(int $limit = 5): Collection
    {
        return $this->model->latest()->take($limit)->get();
    }
}
