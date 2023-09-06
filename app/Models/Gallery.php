<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Gallery extends File
{
    protected $identifier = 'gallery';


    public function getUrl()
    {
        return Storage::url($this->path);
    }
}
