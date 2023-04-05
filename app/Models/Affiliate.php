<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'percentage' => 'float'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Commission::class);
    }
}
