<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function users()
    {
        $users = User::where('role', 'user')->get();
        return DataTables::of($users)
            ->addColumn('actions', function ($data) {
                $text = "<a class='btn  btn-danger' href='" . route('user.delete', $data->id) . "'  onclick=\"return confirm('Are you sure you want to delete this user')\">Delete</a>";
                return $text;
            })
                ->rawColumns(['actions'])
                ->make(true);
    }


    public function delete_user(User $user)
    {
        $current = $user;
        $user->delete();
        request()->session()->flash('msg', 'Person has Successfully deleted!');
        if ($current->role == 'expert') {
            return redirect()->route('experts.index');
        } else {
            return redirect()->route('users.index');
        }
    }
}
