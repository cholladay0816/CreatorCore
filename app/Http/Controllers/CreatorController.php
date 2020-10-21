<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index($name, $page='home')
    {
        //home, gallery, commissions
        $creator = Creator::find($name);
        if(is_null($creator))
        {
            return view('creator.not-found');
        }
        return view('creator.index', ['creator'=>$creator]);
    }
}
