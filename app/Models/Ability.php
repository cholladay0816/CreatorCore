<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ability extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static string $MANAGE_USERS = 'manage-users';
    public static string $MANAGE_CONTENT = 'manage-content';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    protected static function boot()
    {
        self::creating(function ($ability) {
            $ability->slug = Str::slug($ability->title);
        });
        parent::boot();
    }
}
