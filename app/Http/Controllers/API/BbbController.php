<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\User;
use Illuminate\Http\Request;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class BbbController extends Controller
{
    public function recording(Request $request)
    {
        Meeting::where('meetingId', $request->meeting_id)->first()->update([
            'recorded_ready' => true
        ]);
    }

    public function create(Request $request)
    {
        $random_classroom_id = bin2hex(random_bytes(20));

        Bigbluebutton::create([
            'meetingID' => $random_classroom_id,
            'meetingName' => 'Geek Meeting',
            'attendeePW' => 'user',
            'moderatorPW' => 'geek',
            'record' => 'true',
            'autoStartRecording' => true,
            'duration' => $request->talk_time,
            'bbb-recording-ready-url' => config('app.url').'/api/bbb/recordings',
            'endCallbackUrl'  => 'https://expensegeeks.com',
            'logoutUrl' => 'https://expensegeeks.com',
            'logo' => 'https://expensegeeks.com/public/frontend/img/interface/logo.png',
            'welcome' => 'Enjoy meetings with Geek'
        ]);

        $meeting = Meeting::create([
            'meetingId' => $random_classroom_id,
            'geek_id' => $request->geek_id,
            'user_id' => $request->user_id,
            'user_password' => 'user',
            'geek_password' => 'geek',
            'recorded_ready' => false,
            'booking_id' => $request->booking_id,
        ]);
        if ($meeting) {
            $url = Bigbluebutton::join([
                   'meetingID' => $random_classroom_id,
                   'userName' => User::find($request->geek_id)->name,
                   'password' => 'geek'
                ]);
            return redirect()->to($url);
        }
    }

    public function join(Request $request)
    {
        $url = Bigbluebutton::join([
            'meetingID' => $request->meeting_id,
            'userName' => $request->username,
            'password' => 'user'
         ]);
        Booking::find($request->booking_id)->update(['status' => 'finished']);

        return redirect()->to($url);
    }

    public function is_meeting_ready(Request $request)
    {
        return Bigbluebutton::isMeetingRunning($request->meetingId);
    }

    public function get_recordings(Request $request)
    {
        $recording = Bigbluebutton::getRecordings(['mettingID' => $request->id])->where('meetingID', $request->id)->first();
        $data=[];
        $data['published'] =  $recording['published'];
        if ($recording['published']) {
            $data['download'] = 'https://'.parse_url($recording['playback']['format']['url'], PHP_URL_HOST).'/presentation/'.$recording['recordID'].'/video/webcams.webm';
            $data['stream'] =  $recording['playback']['format']['url'];
        }
        return response()->json($data);
    }
}
