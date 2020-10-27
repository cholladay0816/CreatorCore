<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('title')->unique();
    }
}
