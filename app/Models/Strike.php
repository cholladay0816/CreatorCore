<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strike extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkForSuspension()
    {
        $strikes = $this->user->fresh()->strikes->where('expires_at', '>', now());
        if ($strikes->count() >= 3) {
            Suspension::create(['user_id' => $this->user->id, 'reason' => 'Too many strikes.', 'expires_at' => now()->addDays(7)]);

            $strikes->each(function ($strike) {
                $strike->update([
                    'expires_at' => now(),
                ]);
            });
        }
    }

    public static function booted()
    {
        static::created(function ($strike) {
            $strike->checkForSuspension();
        });
    }
}
