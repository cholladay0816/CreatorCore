<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }
}
