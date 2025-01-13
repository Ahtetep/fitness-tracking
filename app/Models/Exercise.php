<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, ExerciseLog> $exerciseLogs
 * @property-read int|null $exercise_logs_count
 * @method static Builder|Exercise newModelQuery()
 * @method static Builder|Exercise newQuery()
 * @method static Builder|Exercise query()
 * @method static Builder|Exercise whereCreatedAt($value)
 * @method static Builder|Exercise whereDescription($value)
 * @method static Builder|Exercise whereId($value)
 * @method static Builder|Exercise whereName($value)
 * @method static Builder|Exercise whereType($value)
 * @method static Builder|Exercise whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';
    protected $fillable = ['name', 'description', 'type'];

    /**
     * Связь упражнения с записями журнала.
     * Один к многим.
     */
    public function exerciseLogs(): HasMany
    {
        return $this->hasMany(ExerciseLog::class);
    }
}
