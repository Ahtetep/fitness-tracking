<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
