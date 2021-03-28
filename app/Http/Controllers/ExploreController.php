<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        $users = User::with('creator')
            ->whereHas('creator', function ($creator) {
                $creator->where('open', 1);
            })->paginate(15);

        return view('explore.index', ['users' => $users]);
    }
}
