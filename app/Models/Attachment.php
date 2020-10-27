<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Events\AttachmentDeleted;

class Attachment extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'deleted' => AttachmentDeleted::class
    ];

    public function canView()
    {
        if($this->is_visible == 1)
            return true;
        if(!auth()->user())
            return false;
        return $this->commission->buyer_id == auth()->user()->id || $this->commission->creator_id == auth()->user()->id;

    }
    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
    public function remove()
    {
        if($this->locked==1)
            return null;
        Storage::delete($this->content);
        return $this->delete();
    }
    public function showcase()
    {
        $this->visible = 1;
        return $this->save();
    }
    public function unlist()
    {
        $this->visible = 0;
        return $this->save();
    }
    public function lock()
    {
        $this->is_locked = 1;
        return $this->save();
    }

    // TODO: Enable Copyright Functionality
    public function claims()
    {
        return null;
    }

    public function activeClaims()
    {
        return null;
    }

}
