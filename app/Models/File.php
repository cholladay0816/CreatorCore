<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $identifier = 'file';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlug()
    {
        return Str::slug($this->id . '-' . str_replace(($this->identifier.'/'), '', $this->path));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getDisk()
    {
        return 'do_public';
    }

    public function getUrl()
    {
        return Storage::disk($this::getDisk())->url($this->path);
    }

    public static function booted()
    {
        static::creating(function ($file) {
            $file->slug = str_replace(($file->identifier.'/'), '', $file->path);
        });
        static::created(function ($file) {
            $file->slug = $file->getSlug();
        });
        static::factory(function ($file) {
            $file->slug = str_replace(($file->identifier.'/'), '', $file->path);
        });

        //If the object is being deleted, remove the saved attachment.
        static::deleting(function ($file) {
            Storage::disk($file::getDisk())->delete($file->path);
        });
    }
}
