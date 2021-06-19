<?php

namespace App\Http\Controllers;

use App\Review;
use App\Payment;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment = Payment::where('transactionno', $request->transactionno)->firstOrFail();
        $user = $payment->user;
        $transactions = $payment->transactions;
        return view('dashboard.review', compact('payment', 'user', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = Review::updateOrCreate(
            ['productid' => $request->productid, 'customerid' => $request->customerid],
            ['rating' => $request->rating, 'content' => $request->content, 'datetime' => now()]
        );
        // $review->product()->associate($request->productid);
        // $review->customer()->associate($request->customerid);
        // $review->rating = $request->rating;
        // $review->content = $request->content;
        // $review->save();

        request()->session()->flash('notify', ['message' => 'Review sent', 'type' => 'success']);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
