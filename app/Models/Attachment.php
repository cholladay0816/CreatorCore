<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Attachment extends File
{
    protected $identifier = 'attachments';

    public static function getDisk()
    {
        return 'do';
    }

    public function canView()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if ($this->review != null) {
            return true;
        }
        if (!$this->commission) {
            return true;
        }
        if ($this->commission->isCreator()) {
            return true;
        }
        if ($this->commission->isBuyer()) {
            if (in_array($this->commission->status, ['Active', 'Overdue', 'Completed', 'Archived'])) {
                return true;
            }
        }
        return false;
    }
    public function getCanViewAttribute()
    {
        return $this->canView();
    }

    public function canEdit()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if (!$this->commission) {
            return true;
        }
        return $this->commission->isCreator() && in_array($this->commission->status, ['Active', 'Overdue']);
    }
    public function getCanEditAttribute()
    {
        return $this->canEdit();
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id');
    }
    public function review(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Review::class);
    }
}
