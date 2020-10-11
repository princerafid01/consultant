<?php

namespace App\Http\Controllers\API;

use App\Favourite;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password'  => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = 'user';
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            return $this->login($request);
        }
    }
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials = Arr::add($credentials, 'role', 'user');


        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => "These credential doesn't match our system."], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json($this->guard()->user()->load(['notifications','userMeetings','user_question','bookings','favourites']));
    }

    public function users()
    {
        $user = User::with('bookings', 'favourites')->where('role', 'user')->get();
        return response()->json($user, 200);
    }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 360,
            'user' => $this->guard()->user()->load(['notifications','userMeetings','user_question','bookings','favourites'])
        ]);
    }

    public function add_to_favourite(Request $request)
    {
        $favourite = Favourite::where('user_id', $request->user_id)
                               ->where('favourite_id', $request->favourite_id)
                               ->first();
        if (!$favourite) {
            Favourite::create($request->all());
        } else {
            $favourite->delete();
        }
        return $this->guard()->user()->load(['notifications','userMeetings','user_question','bookings','favourites']);
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
