<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *HomeController
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $bookings = Booking::all();
            $users = User::where('role', 'user')->get();
            $geeks = User::where('role', 'expert')->get();
            return view('admin.dashboard', compact('bookings', 'users', 'geeks'));
        } else {
            return redirect()->url('/admin/login');
        }
    }
}
