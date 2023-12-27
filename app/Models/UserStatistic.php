<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The purpose of this model is to provide statistics about a user,
 * primarily for the purpose of sorting a creator on the Explore page
 */
class UserStatistic extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'rating',
        'last_login_at',
        'last_commission_at'
    ];
    public $casts = [
        'last_login_at' => 'datetime',
        'last_commission_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
