<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
