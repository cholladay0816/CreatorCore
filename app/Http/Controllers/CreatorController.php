<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index($name, $page='details')
    {
        if($page!='commissions'&&$page!='gallery')
            $page='details';
        //home, gallery, commissions
        $creator = Creator::find($name);
        if(is_null($creator))
        {
            return view('creator.not-found');
        }
        if(auth()->user())
        {
            if (!$creator->user->id == auth()->user()->id) {
                return view('creator.edit', ['creator' => $creator]);
            }
        }
        return view('creator.index', ['creator'=>$creator, 'page'=>$page]);
    }
}
