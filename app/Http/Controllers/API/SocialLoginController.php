<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    public function SocialSignup($provider, $role = 'expert')
    {
        // Socialite will pick response data automatic
        $user = Socialite::driver($provider)->stateless()->user();

        // first will check if the user exist on db
        $existing_user = User::where('email', '=', $user->email)->where('role', $role)->first();
        if ($role == 'expert') {
            $check_role = 'user';
        } else {
            $check_role = 'expert';
        }
        $registered = User::where('email', '=', $user->email)->where('role', $check_role)->first();
        if ($registered) {
            return response()->json(['error' => "You can not use this account."], 401);
        }

        if (!$existing_user) {
            // please check if the username and email is unique
            $new_user = User::create([
                'provider' => $provider,
                'provider_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'username' => strtolower(str_replace(" ", "-", $user->user['family_name'] ?? $user->first_name)). Str::random(2),
                'role' => $role,
                'is_approved' => false,
                'email_verified_at' => Carbon::now()
            ]);
        }
        $this->guard()->login($existing_user ?? $new_user, true);
        // if exists then logged in user
        return response()->json([
            'access_token' => $this->guard()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $this->guard()->user()->load(['notifications','geekReviews','certifications','geek_question','user_question','booked','tags','bookings','favourites','userMeetings','geekMeetings'])
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
