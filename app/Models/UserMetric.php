<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMetric extends Model
{
    use HasFactory;

    protected $table = 'user_metrics';
    protected $fillable = ['user_id', 'recorded_at', 'weight', 'height', 'bmi', 'chest_circumference', 'waist_circumference'];

    /**
     * Связь метрик с пользователем.
     * Многие к одному.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
