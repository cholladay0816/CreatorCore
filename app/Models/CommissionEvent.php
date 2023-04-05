<?php

namespace App\Models;

use App\Models\Scopes\EventForScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionEvent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function commission(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Commission::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(EventForScope::class);
    }
}
