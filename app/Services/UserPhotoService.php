<?php

namespace App\Services;

use App\Models\UserPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserPhotoService extends BaseService
{
    public function __construct(UserPhoto $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить все фотографии пользователя по ID.
     *
     * @param int $userId
     * @return Collection<int, UserPhoto> Фотографии пользователя
     */
    public function getByUserId(int $userId): Collection
    {
        return UserPhoto::whereUserId($userId)->orderBy('uploaded_at', 'desc')->get();
    }

    /**
     * Получить последнюю загруженную фотографию пользователя.
     *
     * @param int $userId
     * @return UserPhoto|null Последняя фотография пользователя
     */
    public function getLastPhotoByUserId(int $userId): ?UserPhoto
    {
        return UserPhoto::whereUserId($userId)->orderBy('uploaded_at', 'desc')->first();
    }

    /**
     * Удалить все фотографии пользователя по ID.
     *
     * @param int $userId
     * @return int Количество удаленных фотографий
     */
    public function deleteByUserId(int $userId): int
    {
        return UserPhoto::whereUserId($userId)->delete();
    }

    /**
     * Найти фотографии пользователя по дате загрузки.
     *
     * @param int $userId
     * @param string $date
     * @return Collection<int, UserPhoto> Фотографии пользователя за указанную дату
     */
    public function getPhotosByDate(int $userId, string $date): Collection
    {
        return UserPhoto::whereUserId($userId)
            ->whereDate('uploaded_at', $date)
            ->orderBy('uploaded_at', 'asc')
            ->get();
    }
}
