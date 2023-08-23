<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function show(Gallery $gallery)
    {
        //return $gallery;
        return response()->file(Storage::path($gallery->path));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'image|max:' . min(config('gallery.max_file_size'), config('gallery.max_size'))
        ]);
        $file = $request->file->store('gallery', Gallery::getDisk());
        Gallery::create([
            'size' => $request->file->getSize(),
            'path' => $file,
            'type' => $request->file->getMimeType(),
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->to(route('creator.show', [auth()->user(), 'gallery']));
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->user_id != auth()->id()) {
            abort(403);
        }

        $gallery->delete();

        return redirect()->back()->with(['success' => 'Gallery image deleted.']);
    }
}
