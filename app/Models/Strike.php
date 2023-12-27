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
        $strikes = $this->user->strikes()->where('expires_at', '>', now())->get();
        if ($strikes->count() >= 3) {
            Suspension::create(['user_id' => $this->user_id, 'reason' => 'Too many strikes.', 'expires_at' => now()->addDays(7)]);

            $strikes->each(function ($strike) {
                $strike->forceFill([
                    'expires_at' => now(),
                ])->save();
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
