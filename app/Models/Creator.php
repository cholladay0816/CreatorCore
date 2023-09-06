<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Creator extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'open' => 'boolean',
        'allows_custom_commissions' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commissionPresets(): HasMany
    {
        return $this->hasMany(CommissionPreset::class, 'user_id', 'user_id');
    }

    public function banner_url(): string|null {
        if(is_null($this->banner_path))
        {
            return null;
        }

        return Storage::url($this->banner_path);
    }
}
