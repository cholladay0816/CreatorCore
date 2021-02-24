<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', ['notifications' => $notifications]);
    }


    /**
     * Display the specified resource.
     *
     * @param Notification $notification
     * @return Application|Factory|View|Response
     */
    public function show(Notification $notification)
    {
        return view('notifications.show', ['notification' => $notification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Notification $notification
     * @return Response
     */
    public function update(Request $request, Notification $notification): Response
    {
        if ($notification->read_at != null || $notification->user->id != auth()->id()) {
            abort(401);
        }
        $notification->read_at = now();
        $notification->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notification $notification
     * @return Response
     */
    public function destroy(Notification $notification): Response
    {
        if ($notification->user->id != auth()->id()) {
            abort(401);
        }
        $notification->delete();
    }
}
