<?php

namespace App\Services;

use App\Models\UserMetric;
use Illuminate\Database\Eloquent\Collection;

class UserMetricService extends BaseService
{
    public function __construct(UserMetric $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить метрики пользователя по ID.
     *
     * @param int $userId
     * @return Collection<int, UserMetric> Метрики пользователя
     */
    public function getByUserId(int $userId): Collection
    {
        return UserMetric::whereUserId($userId)->orderBy('recorded_at', 'desc')->get();
    }

    /**
     * Получить последнюю метрику пользователя.
     *
     * @param int $userId
     * @return UserMetric|null Последняя метрика пользователя
     */
    public function getLastMetricByUserId(int $userId): ?UserMetric
    {
        return UserMetric::whereUserId($userId)->orderBy('recorded_at', 'desc')->first();
    }

    /**
     * Найти метрики в определенный диапазон дат для пользователя.
     *
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return Collection<int, UserMetric> Метрики в диапазоне дат
     */
    public function getMetricsByDateRange(int $userId, string $startDate, string $endDate): Collection
    {
        return UserMetric::whereUserId($userId)
            ->whereBetween('recorded_at', [$startDate, $endDate])
            ->orderBy('recorded_at', 'asc')
            ->get();
    }

    /**
     * Получить средний показатель веса пользователя в заданный диапазон дат.
     *
     * @param int $userId
     * @param string $startDate
     * @param string $endDate
     * @return float|null Средний вес пользователя
     */
    public function getAverageWeightByDateRange(int $userId, string $startDate, string $endDate): ?float
    {
        return UserMetric::whereUserId($userId)
            ->whereBetween('recorded_at', [$startDate, $endDate])
            ->avg('weight');
    }

    /**
     * Получить последние метрики.
     *
     * @param int $limit
     * @return Collection<int, UserMetric>
     */
    public function getLatest(int $limit = 5): Collection
    {
        return $this->model->latest()->take($limit)->get();
    }
}
