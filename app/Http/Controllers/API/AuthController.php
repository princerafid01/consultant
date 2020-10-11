<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'username' => 'string|required|max:255|alpha_dash|unique:users',
            // 'phone' => 'required',
            'name' => 'required|max:18',
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
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->role = 'expert';
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
        $credentials = Arr::add($credentials, 'role', 'expert');

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
        return response()->json($this->guard()->user()->load(['notifications','geekReviews','certifications','geek_question','user_question','booked','tags','bookings','favourites','userMeetings','geekMeetings']));
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
            'user' => $this->guard()->user()->load(['notifications','geekReviews','certifications','geek_question','user_question','booked','tags','bookings','favourites','userMeetings','geekMeetings'])
        ]);
    }



    public function edit_profile(User $user, Request $request)
    {
        if (isset($request->passwords['current_password'])) {
            if (Hash::check($request->passwords['current_password'], $user->password)) {
                $user->password = bcrypt($request->passwords['new_password']);
                $user->save();
            } else {
                return response()->json(['Password doesn\'t match.'], 444);
            }
        }
        $tags = collect($request->user['tags'])->map(function ($tag) {
            if (!isset($tag['id'])) {
                $new_tag = Tag::create([
                    'name' => $tag['name']
                ]);
                $tag['id'] = $new_tag->id;
            }
            return $tag['id'];
        });
        $user_data = $request->user;
        if (isset($user_data['tags'])) {
            unset($user_data['tags']);
        }
        unset($user_data['posts']);
        unset($user_data['certifications']);
        unset($user_data['geek_question']);
        unset($user_data['user_question']);
        unset($user_data['booked']);
        unset($user_data['bookings']);
        unset($user_data['favourites']);
        unset($user_data['user_meetings']);
        unset($user_data['geek_meetings']);
        unset($user_data['geek_reviews']);
        unset($user_data['notifications']);
        $user->update($user_data);
        $user->tags()->sync($tags);
        return response()->json($user->load(['notifications','geekReviews','certifications','geek_question','user_question','booked','tags','bookings','favourites','userMeetings','geekMeetings']), 200);
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

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        $userExists = User::where('email', $request->email)->where('role', $request->role)->where('password', '!=', '')->first();
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } elseif (!$userExists) {
            $arr = array("status" => 400, "message" => 'We can not find such user', "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
    }
}
