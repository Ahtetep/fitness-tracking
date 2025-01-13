<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
