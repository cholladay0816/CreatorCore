<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Creator extends Model
{
    use HasFactory;
    protected $primaryKey = 'displayname';

    public $incrementing = false;

    protected $keyType = 'string';

    public function isCurrentUser()
    {
        if(!auth()->user())
            return false;

        return $this->user_id == auth()->user()->id;
    }
    public function canBeEdited()
    {
        return $this->isCurrentUser() || Gate::allows('edit-users');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deletePresets()
    {
        foreach ($this->user->presets as $preset)
        {
            $preset->delete();
        }
    }
    public function deleteGallery()
    {
        foreach ($this->user->gallery as $gallery)
        {
            $gallery->remove();
        }
    }
    public function commissionCount()
    {
        return $this->user->presets->count();
    }
    public function galleryCount()
    {
        return $this->user->gallery->count();
    }
    public function reviewCount()
    {
        return $this->user->reviews->count();
    }
    public function set_commissions_enabled($int)
    {
        $this->commissions_enabled = $int;
        return $this->save();
    }
    public function set_custom_commissions_allowed($int)
    {
        $this->custom_commissions_allowed = $int;
        return $this->save();
    }
}
