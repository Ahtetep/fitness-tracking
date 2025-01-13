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
 * @property string $recorded_at
 * @property float $weight
 * @property float|null $height
 * @property float|null $bmi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property float|null $chest_circumference
 * @property float|null $waist_circumference
 * @property float|null $hip_circumference
 * @property float|null $navel_circumference
 * @property-read User $user
 * @method static Builder|UserMetric newModelQuery()
 * @method static Builder|UserMetric newQuery()
 * @method static Builder|UserMetric query()
 * @method static Builder|UserMetric whereBmi($value)
 * @method static Builder|UserMetric whereChestCircumference($value)
 * @method static Builder|UserMetric whereCreatedAt($value)
 * @method static Builder|UserMetric whereHeight($value)
 * @method static Builder|UserMetric whereHipCircumference($value)
 * @method static Builder|UserMetric whereId($value)
 * @method static Builder|UserMetric whereNavelCircumference($value)
 * @method static Builder|UserMetric whereRecordedAt($value)
 * @method static Builder|UserMetric whereUpdatedAt($value)
 * @method static Builder|UserMetric whereUserId($value)
 * @method static Builder|UserMetric whereWaistCircumference($value)
 * @method static Builder|UserMetric whereWeight($value)
 * @mixin Eloquent
 */
class UserMetric extends Model
{
    use HasFactory;

    protected $table = 'user_metrics';
    protected $fillable = [
        'user_id',
        'recorded_at',
        'weight',
        'height',
        'bmi',
        'chest_circumference',
        'waist_circumference',
        'hip_circumference',
        'navel_circumference',
    ];

    /**
     * Связь метрик с пользователем.
     * Многие к одному.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
