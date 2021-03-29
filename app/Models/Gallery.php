<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlug()
    {
        return Str::slug($this->id . '-' . str_replace('gallery/', '', $this->path));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::creating(function ($gallery) {
            $gallery->slug = str_replace('gallery/', '', $gallery->path);
        });
        static::created(function ($gallery) {
            $gallery->slug = $gallery->getSlug();
        });
        static::factory(function ($gallery) {
            $gallery->slug = str_replace('gallery/', '', $gallery->path);
        });

        //If the object is being deleted, remove the saved attachment.
        static::deleting(function ($gallery) {
            Storage::delete($gallery->path);
        });
    }
}
