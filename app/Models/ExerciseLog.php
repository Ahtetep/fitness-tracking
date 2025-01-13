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
 * @property int $exercise_id
 * @property int|null $repetitions
 * @property int|null $time
 * @property float|null $distance
 * @property int|null $calories
 * @property string $logged_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Exercise $exercise
 * @property-read User $user
 * @method static Builder|ExerciseLog newModelQuery()
 * @method static Builder|ExerciseLog newQuery()
 * @method static Builder|ExerciseLog query()
 * @method static Builder|ExerciseLog whereCalories($value)
 * @method static Builder|ExerciseLog whereCreatedAt($value)
 * @method static Builder|ExerciseLog whereDistance($value)
 * @method static Builder|ExerciseLog whereExerciseId($value)
 * @method static Builder|ExerciseLog whereId($value)
 * @method static Builder|ExerciseLog whereLoggedAt($value)
 * @method static Builder|ExerciseLog whereRepetitions($value)
 * @method static Builder|ExerciseLog whereTime($value)
 * @method static Builder|ExerciseLog whereUpdatedAt($value)
 * @method static Builder|ExerciseLog whereUserId($value)
 * @mixin Eloquent
 */
class ExerciseLog extends Model
{
    use HasFactory;

    protected $table = 'exercise_logs';
    protected $fillable = ['user_id', 'exercise_id', 'repetitions', 'time', 'distance', 'calories', 'logged_at'];

    /**
     * Связь записи журнала с пользователем.
     * Многие к одному.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь записи журнала с упражнением.
     * Многие к одному.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
