<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        $users = User::getExploreCreatorQuery()
            ->paginate(16);

        return view(
            'explore.index',
            [
                'users' => $users,
                'prevPage' => $users->previousPageUrl(),
                'nextPage' => $users->nextPageUrl(),
                'first' => $users->firstItem(),
                'last' => $users->lastItem(),
                'total' => $users->total()
            ]
        );
    }
    public function commissionSearch()
    {
        return view('explore.find-a-gig');
    }
}
