<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        return $this->hasMany(GalleryClaim::class)
            ->where('status', '=', 'Active');
    }

    public function isClaimed()
    {
        return $this->claims()->count()>0;
    }

    public function canView()
    {
        //TODO: Add Copyright Logic

        if($this->isClaimed())
            return false;

        if($this->is_visible == 1)
            return true;
        if($this->user_id == auth()->user()->id)
            return true;

        return false;
    }
    public function canBeEdited()
    {
        if(auth()->user() === null)
            return false;
        if(Gate::allows('edit-users'))
            return true;
        return ($this->user_id == auth()->user()->id);
    }
    public function remove()
    {
        Storage::delete($this->content);
        return $this->delete();
    }
}
