<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;
    protected $primaryKey = 'displayname';

    public $incrementing = false;

    protected $keyType = 'string';

    public function isCurrentUser()
    {
        if(!auth()->user())
            return false;

        return $this->user_id == auth()->user()->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commissions_enabled($int)
    {
        $this->commissions_enabled = $int;
        return $this->save();
    }
    public function custom_commissions_allowed($int)
    {
        $this->custom_commissions_allowed = $int;
        return $this->save();
    }
}
