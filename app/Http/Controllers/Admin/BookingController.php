<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }

    public function bookings()
    {
        $bookings = Booking::with('user', 'geek')->get();
        return DataTables::of($bookings)
        ->editColumn('geek_id', function (Booking $booking) {
            return $booking->geek->name;
        })
        ->editColumn('user_id', function (Booking $booking) {
            return $booking->user->name;
        })
        ->editColumn('date', function (Booking $booking) {
            return Carbon::parse($booking->date)->format('M d, Y');
        })
        ->editColumn('charge', function (Booking $booking) {
            return '$ '.$booking->talk_time * $booking->payment->charge;
        })
        ->addColumn('geek_email', function (Booking $booking) {
            return $booking->geek->email;
        })
                ->rawColumns(['geek_email'])
                ->make(true);
    }
}
