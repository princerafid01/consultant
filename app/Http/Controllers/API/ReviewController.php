<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $review = Review::create($request->data['input']);
        $booking = Booking::find($request->data['booking_id']);
        $booking->review_id =  $review->id;
        $booking->save();
        return response()->json($booking);
    }
}
