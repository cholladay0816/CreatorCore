<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    protected static function boot()
    {
        self::creating(function ($role) {
            $role->slug = Str::slug($role->title);
        });
        parent::boot();
    }
}
