<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Review $review
     * @return Response
     */
    public function create(Review $review)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Review $review
     * @param Request $request
     * @return Response
     */
    public function store(Review $review, Request $request)
    {
        $res = $request->validate([
            'positive' => 'required|boolean'
        ]);
        $rating = Rating::create([
            'user_id' => auth()->id(),
            'review_id' => $review->id,
            'positive' => $res['positive']
        ]);
        return \response('Rating created', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Rating $rating
     * @return Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rating $rating
     * @return Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rating $rating
     * @return Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
