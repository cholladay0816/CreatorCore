<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claim()
    {
        return $this->hasMany(GalleryClaim::class)
            ->where('status', '=', 'Active')
            ->first();
    }

    public function isClaimed()
    {
        return $this->claim->isActive();
    }

    public function canView()
    {
        //TODO: Add Copyright Logic

        if($this->isClaimed())

        if($this->is_visible == 1)
            return true;
        if($this->user_id == auth()->user()->id)
            return true;

        return false;
    }
    public function remove()
    {
        if($this->locked==1)
            return null;
        Storage::delete($this->content);
        return $this->delete();
    }
}
