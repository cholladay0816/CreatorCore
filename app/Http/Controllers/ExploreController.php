<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        $creators = Creator::where('accepting_commissions', '1')->get();
        return view('explore.index', ['creators'=>$creators]);
    }
}
