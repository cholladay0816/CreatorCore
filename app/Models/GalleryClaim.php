<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryClaim extends Model
{
    use HasFactory;

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function isActive()
    {
        return $this->status == "Active";
    }
}
