<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function canView()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if ($this->review != null) {
            return true;
        }
        if ($this->commission->isCreator()) {
            return true;
        }
        if ($this->commission->isBuyer()) {
            if (in_array($this->commission->status, ['Completed', 'Archived'])) {
                return true;
            }
        }
        return false;
    }

    public function canEdit()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        return $this->commission->isCreator() && in_array($this->commission->status, ['Active', 'Overdue']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
    public function review(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function getSlug()
    {
        return Str::slug($this->id . '-' . str_replace('attachments/', '', $this->path));
    }

    public static function booted()
    {
        static::creating(function ($attachment) {
            $attachment->slug = str_replace('attachments/', '', $attachment->path);
        });
        static::created(function ($attachment) {
            $attachment->slug = $attachment->getSlug();
        });
        static::factory(function ($attachment) {
            $attachment->slug = str_replace('attachments/', '', $attachment->path);
        });

        //If the object is being deleted, remove the saved attachment.
        static::deleting(function ($attachment) {
            Storage::delete($attachment->path);
        });
    }
}
