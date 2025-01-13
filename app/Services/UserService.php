<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserMetric;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Найти пользователя по email.
     *
     * @param string $email
     * @return User|null Пользователь или null, если не найден
     */
    public function findByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    /**
     * Получить всех пользователей с подтвержденным email.
     *
     * @return Collection<int, User> Коллекция пользователей с подтвержденным email
     */
    public function getVerifiedUsers(): Collection
    {
        return User::whereNotNull('email_verified_at')->get();
    }

    /**
     * Получить записи журнала пользователя по его ID.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection Записи журнала пользователя
     */
    public function getExerciseLogs(int $userId): \Illuminate\Support\Collection
    {
        return $this->getById($userId)?->exerciseLogs ?? collect();
    }

    /**
     * Получить фотографии пользователя по его ID.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection Фотографии пользователя
     */
    public function getPhotos(int $userId): \Illuminate\Support\Collection
    {
        return $this->getById($userId)?->photos ?? collect();
    }

    /**
     * Получить метрики пользователя по его ID.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection Метрики пользователя
     */
    public function getMetrics(int $userId): \Illuminate\Support\Collection
    {
        return $this->getById($userId)?->metrics ?? collect();
    }
}
