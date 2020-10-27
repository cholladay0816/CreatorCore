<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\CommissionPreset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function view(Attachment $attachment)
    {
        if(!$attachment->canView())
        {
            abort(401);
        }
        $file = Storage::get($attachment->content);
        $type = Storage::mimeType($attachment->content);

        return response($file,'200',["Content-Type"=>$type]);
    }

    public function create(Commission $commission)
    {
        if($commission->status != 'Active' || !$commission->isCreator())
        {
            abort(401);
        }
        return view('attachment.create', ['commission'=>$commission]);
    }
    public function store(Commission $commission, Request $request)
    {
        if($commission->status != 'Active' || !$commission->isCreator())
        {
            abort(401);
        }
        request()->validate([
            'file' => 'required|file|image|max:4096' //Must be an image file (4MB limit)
        ]);

        $path = $request->file('file')->store('attachments');

        $attachment = new Attachment();
        $attachment->user_id = auth()->user()->id;
        $attachment->commission_id = $commission->id;
        $attachment->content = $path;
        $attachment->size = $request->file('file')->getSize();
        $attachment->save();
        return redirect(url('commission/'.$attachment->commission_id));
    }

    public function delete(Attachment $attachment)
    {
        if($attachment->user_id === auth()->user()->id) {
            $attachment->delete();
            return redirect( url('/commission/'.$attachment->commission_id));
        }
        else
        {
            return abort(401);
        }
    }
}
