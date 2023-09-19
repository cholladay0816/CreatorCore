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

    public static $IMAGE_RULES = ['nullable', 'image','max:10240'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function image_url()
    {
        if(is_null($this->image_path)) {
            return null;
        }

        return Storage::url($this->image_path);
    }

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

    public function ratings()
    {
        return $this->hasManyThrough(Review::class, Commission::class, 'commission_preset_id', 'commission_id');
    }

    public function rating(): float|null
    {
        $ratings = $this->ratings();
        if ($ratings->count() == 0) {
            return null;
        }
        return number_format(floatval($ratings->sum('positive')) / floatval($ratings->count()), 2);
    }

    public function getSlug()
    {
        return Str::slug($this->id ?? ($this->user_id . '-' . now()->format('mdY-Hi')). '-' . $this->title);
    }

    public static function booted()
    {
        static::creating(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
        static::created(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
        static::updating(function ($preset) {
            if($preset->isDirty('image_path') && !is_null($preset->getOriginal('image_path'))) {
                Storage::delete($preset->getOriginal('image_path'));
            }
        });
        static::deleting(function ($preset) {
            if(!is_null($preset->image_path)) {
                Storage::delete($preset->image_path);
            }
        });
        static::factory(function ($preset) {
            $preset->slug = $preset->getSlug();
        });
    }
}
