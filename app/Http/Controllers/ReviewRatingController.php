<?php

namespace App\Http\Controllers;

use App\Models\ReviewRating;
use Illuminate\Http\Request;

class ReviewRatingController extends Controller
{
    public function store()
    {
        $response = \request()->validate(
            ['review_id'=>'required|exists:reviews',
            'positive'=>'required|integer|min:0|max:1']
        );

        $rating = ReviewRating::firstOrNew(['user_id'=>auth()->user()->id,
            'review_id'=>\request('review_id')]);
        $rating->save();
        return redirect()->back()->with('success', 'Rating Applied');
    }
    public function delete(ReviewRating $rating)
    {
        $rating->delete();
        return redirect()->back()->with('success', 'Rating Removed');
    }
}
