<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPreset extends Model
{
    use HasFactory;

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
}
