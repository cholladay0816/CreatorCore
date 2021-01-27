<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }

    public static function booted()
    {
        //If the object is being deleted, remove the saved attachment.
        static::deleting(function ($attachment) {
            Storage::delete(storage_path($attachment->path));
        });
    }
}
