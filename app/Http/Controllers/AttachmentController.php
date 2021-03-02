<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Commission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function show(Attachment $attachment)
    {
        return response(Storage::get($attachment->path), '200', ["Content-Type"=>$attachment->type]);
    }
}
