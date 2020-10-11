<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeekController extends Controller
{
    public function index()
    {
        $geeks = User::with('tags', 'certifications', 'geekReviews', 'booked')
                    ->where('role', '=', 'expert')
                    ->where('is_approved', '1')
                    ->where('id', '!=', Auth::check() ? auth()->user()->id : 0)
                    ->get();
        return response()->json($geeks);
    }

    public function findByUsername($username)
    {
        $geek = User::where('username', '=', $username)->get();
        return response()->json($geek);
    }
}
