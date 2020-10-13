<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function view(Gallery $gallery)
    {
        if(!$gallery->canView())
        {
            abort(401);
        }
        $file = Storage::get($gallery->content);
        $type = Storage::mimeType($gallery->content);

        return response($file,'200',["Content-Type"=>$type]);
    }
}
