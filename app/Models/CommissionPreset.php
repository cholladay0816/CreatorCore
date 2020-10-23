<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPreset extends Model
{
    use HasFactory;


    public function url()
    {
        if($this->isOwner())
        {
            return url('/commissionpreset/'.$this->id);
        }
        else
        {
            return $this->isEnabled()?url('/commission/create/'.$this->id):'javascript:;';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isEnabled()
    {
        return $this->user->creator->accepting_commissions;
    }

    public function isOwner()
    {
        if(!auth()->user())
            return false;

        return $this->user_id == auth()->user()->id;
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'preset_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
