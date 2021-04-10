<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'read_at'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function read()
    {
        return $this->read_at != null;
    }
    public function getReadAttribute()
    {
        return $this->read();
    }
}
