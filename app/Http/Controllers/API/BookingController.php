<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Notification;
use Illuminate\Http\Request;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class BookingController extends Controller
{
    public function update(Request $request)
    {
        Booking::find($request->id)->update([
            'geek_id' => $request->geek_id,
            'user_id' => $request->user_id,
            'payment_id' => $request->payment_id,
            'date' => $request->date,
            'time' => $request->time,
            'timezone' => $request->timezone,
            'talk_time' => $request->talk_time,
            'status' => 'approved',
        ]);


        Notification::create([
            'user_id' => $request->user_id,
            'notification_page' => 'Bookings'
        ]);


        $user_booking = Booking::where('user_id', $request->user_id)->get();
        return response()->json($user_booking);
    }
}
