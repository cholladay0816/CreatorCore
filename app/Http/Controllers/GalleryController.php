<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
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

        return response($file,'200',["title"=>$gallery->title.' - CreatorCore',"Content-Type"=>$type]);
    }

    public function store(Request $request)
    {
        //validation

        request()->validate([
            'file' => 'required|file|image|max:4096', //Must be an image file (4MB limit)
            'title' => 'nullable|max:255',
            'description' => 'nullable|max:255'
        ]);

        $path = $request->file('file')->store('gallery');

        $gallery = new Gallery();
        $gallery->user_id = auth()->user()->id;
        if(request('title'))
            $gallery->title = request('title');
        if(request('description'))
            $gallery->description = request('description');
        $gallery->content = $path;
        $gallery->size = $request->file('file')->getSize();
        $gallery->is_visible = 1;
        $gallery->save();
        return redirect(url('/'.$gallery->user->creator->displayname.'/gallery'));

    }
}
