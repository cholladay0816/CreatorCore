<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Commission $commission)
    {
        return view('review.create', ['commission'=>$commission]);
    }

    public function store(Commission $commission)
    {
        //validation
        $response = \request()->validate([''=>'']);
        $review = new Review();

        $review->save();
        return redirect(url('/reviews/'.$review->id));
    }

    public function edit(Review $review)
    {
        if($review->user_id != auth()->user()->id)
            abort(401);
        return view('review.edit', ['review'=>$review]);
    }

    public function update(Review $review)
    {
        if($review->user_id != auth()->user()->id)
            abort(401);
        $review->delete();
        return redirect()->back()->with('success', 'Review Deleted');
    }

    public function delete(Review $review)
    {
        if($review->user_id != auth()->user()->id)
            abort(401);
        $review->delete();
        return redirect()->back()->with('success', 'Review Deleted');
    }
}
