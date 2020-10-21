<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
    public function reviewer()
    {
        return $this->hasOne(User::class, 'reviewer_id');
    }
    public function reviewee()
    {
        return $this->commission->creator;
    }
}
