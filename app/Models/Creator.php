<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
}
