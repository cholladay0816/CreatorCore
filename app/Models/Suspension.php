<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'expires_at'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function expired(): bool
    {
        if (is_null($this->expires_at)) {
            return false;
        }
        return $this->expires_at <= now();
    }
    public function getExpiredAttribute(): bool
    {
        return $this->expired();
    }
}
