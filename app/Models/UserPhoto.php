<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
