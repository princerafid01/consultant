<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function get_number()
    {
        $notification_number = Notification::where('user_id', auth()->user()->id)->where(
            'is_read',
            false
        )->count();
        return response()->json($notification_number);
    }

    public function mark_read(Notification $notification)
    {
        $notification->is_read = true;
        $notification->save();
        return response()->json($notification);
    }

    public function mark_read_all()
    {
        DB::table('notifications')->where('is_read', false)->update(['is_read' => true]);
        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return response()->json($notifications);
    }

    public function delete_notification(Notification $notification)
    {
        $id = $notification->id;
        $notification->delete();
        return response()->json(['id' => $id]);
    }
}
