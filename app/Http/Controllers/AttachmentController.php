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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Commission $commission
     * @return Application|RedirectResponse|Response|Redirector|void
     */
    public function store(Request $request, Commission $commission)
    {
        if (!$commission->isCreator()) {
            return abort(404);
        }
        $res = $request->validate([
            'file' => 'required|file|image|max:4096' //Must be an image file (4MB limit)
        ]);
        $path = $request->file('file')->store('attachments');
        $attachment = new Attachment();
        $attachment->user_id = auth()->user()->id;
        $attachment->commission_id = $commission->id;
        $attachment->path = $path;
        $attachment->size = $request->file('file')->getSize();
        $attachment->save();
        return redirect()
            ->to(route('commissions.show', $commission))
            ->with(['success' => 'Attachment created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Attachment $attachment
     * @return Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attachment $attachment
     * @return RedirectResponse | void
     */
    public function destroy(Attachment $attachment)
    {
        $commission = $attachment->commission;
        if (!$commission->isCreator()) {
            abort(401);
        }
        // Make sure the commission is not completed
        if ($commission->status != 'Active') {
            abort(401);
        }

        $attachment->delete();

        return redirect()
            ->to(route('commissions.show', $commission))
            ->with('success', 'Attachment deleted');
    }
}
