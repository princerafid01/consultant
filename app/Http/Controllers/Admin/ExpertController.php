<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        return view('admin.geeks.index');
    }

    public function geeks()
    {
        $experts = User::where('role', 'expert')->get();
        if ($status = request('status')) {
            $experts  = $experts->where('is_approved', ($status == 'approved') ? 1 : 0);
        }
        return DataTables::of($experts)
                ->editColumn('is_approved', function (User $user) {
                    if ($user->is_approved) {
                        $view = "<span class='label label-success'>Approved</span>";
                    } else {
                        $view = "<span class='label label-success bg-maroon'>Not Approved</span>";
                    }
                    return $view;
                })
                ->addColumn('action', function (User $user) {
                    $view = '
                    <a href="' .  route("view.geeks", $user->id) .'" class="btn bg-info">View Profile</a>
                    <a href="'. route('user.delete', $user->id) .'" class="btn bg-maroon"  onclick="return confirm(\'Are you sure you want to delete this geek\')"> <i class="fa fa-trash"></i></a>
                    ';
                    return $view;
                })
                ->rawColumns(['is_approved','action'])
                ->make(true);
    }

    public function status(User $user)
    {
        $user->is_approved = !$user->is_approved;
        Notification::create([
            'user_id' => $user->id,
            'notification_page' => 'Profile'
        ]);
        if ($user->save()) {
            request()->session()->flash('msg', 'Expert status has Successfully changed');
            return back();
        }
    }

    public function show(User $user)
    {
        return view('admin.geeks.show', compact('user'));
    }
}
