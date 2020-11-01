<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Polyfill\Ctype\Ctype;

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
        return view('creator.index', ['creator'=>$creator, 'page'=>$page]);
    }

    public function create()
    {
        $creator = Creator::where('user_id','=',auth()->user()->id)->first();
        if($creator)
            return redirect(url('/creator/edit/'.$creator->displayname))->with('error', 'Creator Already Exists');
        return view('creator.create');
    }
    public function store()
    {
        $response = \request()->validate(['displayname'=>'required|unique:creators|max:64', 'bio'=>'max:255']);
        $creator = Creator::where('user_id','=',auth()->user()->id)->first();
        if($creator)
            return redirect(url('/creator/edit/'.$creator->displayname))->with('error', 'Creator Already Exists');

        $creator = new Creator();
        $creator->user_id = auth()->user()->id;
        $creator->displayname = $response['displayname'];
        $creator->bio = $response['bio'];
        $creator->save();
        return redirect(url('/'.$creator->displayname));
    }
    public function edit(Creator $creator)
    {
        if($creator->user_id != auth()->user()->id && Gate::denies('edit-users'))
            abort(401);
        return view('creator.edit',['creator'=>$creator]);
    }
    public function update(Creator $creator)
    {
        $response = request()->validate(
            ['displayname'=>'required|unique:creators,displayname,'.$creator->id,
                'bio'=>'max:256'
            ]
        );
        if($creator->user_id != auth()->user()->id && Gate::denies('edit-users'))
            abort(401);
        $creator->displayname = request('displayname');
        if(request('bio'))
            $creator->bio = request('bio');
        $creator->save();
        return redirect()->back();
    }
    public function delete(Creator $creator)
    {
        if($creator->user_id != auth()->user()->id && Gate::denies('edit-users'))
            abort(401);

        $creator->deletePresets();
        $creator->deleteGallery();
        //$creator->delete();
    }
}
