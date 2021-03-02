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
}
