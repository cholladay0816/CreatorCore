<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommissionPreset extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function displayTitle()
    {
        return '[$' . $this->price . '] ' . $this->title . ' - ' . $this->user->name;
    }
    public function getDisplayTitleAttribute()
    {
        return $this->displayTitle();
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function getSlug()
    {
        return Str::slug($this->id??'' . '-' . $this->title);
    }

    public static function booted()
    {
        static::creating(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
        static::created(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
        static::factory(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
    }
}
