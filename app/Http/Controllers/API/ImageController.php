<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload_avatar(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($request->folderName);
            User::find($request->id)->update([
                'avatar' => $path
            ]);
            return $path;
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($request->folderName);
            return $path;
        }
    }
}
