<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Actionable;

class Report extends Model
{
    use Actionable;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function target()
    {
        return ($this->model)::find($this->model_id);
    }
    public function getTargetAttribute()
    {
        return $this->target();
    }


    public function resolve($note = null)
    {
        $this->action_description = $note;
        $this->status = 'Resolved';
        $this->save();
    }

    public function close($note = null)
    {
        $this->status = 'Closed';
        $this->action_description = $note;
        $this->save();
    }
}
