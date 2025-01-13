<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $photo_path
 * @property string $uploaded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|UserPhoto newModelQuery()
 * @method static Builder|UserPhoto newQuery()
 * @method static Builder|UserPhoto query()
 * @method static Builder|UserPhoto whereCreatedAt($value)
 * @method static Builder|UserPhoto whereId($value)
 * @method static Builder|UserPhoto wherePhotoPath($value)
 * @method static Builder|UserPhoto whereUpdatedAt($value)
 * @method static Builder|UserPhoto whereUploadedAt($value)
 * @method static Builder|UserPhoto whereUserId($value)
 * @mixin Eloquent
 */
class UserPhoto extends Model
{
    use HasFactory;

    protected $table = 'user_photos';
    protected $fillable = ['user_id', 'photo_path', 'uploaded_at'];

    /**
     * Связь фотографий с пользователем.
     * Многие к одному.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
