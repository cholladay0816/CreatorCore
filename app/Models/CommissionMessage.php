<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'commissions_messages';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function commission(): BelongsTo|Commission
    {
        return $this->belongsTo(Commission::class);
    }

    public function user(): BelongsTo|User
    {
        return $this->belongsTo(User::class);
    }
}
