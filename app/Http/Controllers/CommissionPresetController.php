<?php

namespace App\Http\Controllers;

use App\Models\CommissionPreset;
use App\Models\CommissionPresetTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class CommissionPresetController extends Controller
{
    public function view(CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user_id != auth()->user()->id)
            abort(404);
        return view('commissionpreset.view', ['commissionPreset'=>$commissionPreset]);
    }
    public function create()
    {
        return view('commissionpreset.create', ['title'=>'Create Commission Preset']);
    }
    public function store()
    {
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'price'=> 'numeric|required|min:5|max:1000',
            'min_days_to_complete' => 'numeric|required|min:1|max:365',
            'days_to_complete' => 'numeric|required|min:1|max:365',
        ]);
        $commissionPreset = new CommissionPreset();
        $commissionPreset->title = request('title');
        $commissionPreset->description = request('description');
        $commissionPreset->price = request('price');
        $commissionPreset->min_days_to_complete = request('min_days_to_complete');
        $commissionPreset->days_to_complete = request('days_to_complete');
        $commissionPreset->user_id = auth()->user()->id;
        $commissionPreset->save();
        return redirect('/'.auth()->user()->creator->displayname.'/commissions');
    }
    public function edit(CommissionPreset $commissionPreset)
    {
        $tags = Tag::all();
        $categories = Tag::all()->pluck('art_type')->unique()->toArray();
        if($commissionPreset->user_id != auth()->user()->id)
            abort(404);
        return view('commissionpreset.create', ['title'=>'Edit Commission Preset',
            'commissionPreset'=>$commissionPreset, 'tags'=>$tags, 'categories'=>$categories]);
    }
    public function update(CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user_id != auth()->user()->id)
            abort(401);
        request()->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:3',
            'price'=> 'numeric|required|min:5|max:1000',
            'min_days_to_complete' => 'numeric|required|min:1|max:365',
            'days_to_complete' => 'numeric|required|min:1|max:365',
        ]);
        $commissionPreset->title = request('title');
        $commissionPreset->description = request('description');
        $commissionPreset->price = request('price');
        $commissionPreset->min_days_to_complete = request('min_days_to_complete');
        $commissionPreset->days_to_complete = request('days_to_complete');
        $commissionPreset->save();
        //If a tag was submitted, apply it
        if(\request('tag'))
        {
            //Delete all existing tags
            $commissionPreset->belongsToMany(Tag::class)->detach();
            //If a tag is on the list, add it.
            if(Tag::find(\request('tag')))
                $commissionPreset->belongsToMany(Tag::class)->attach(['tag_id'=>request('tag')]);
        }
        return redirect('/'.auth()->user()->creator->displayname.'/commissions');
    }
    public function delete(CommissionPreset $commissionPreset)
    {
        if($commissionPreset->user_id != auth()->user()->id)
            abort(401);
        $commissionPreset->delete();

        return redirect('/'.auth()->user()->creator->displayname.'/commissions');
    }
}
