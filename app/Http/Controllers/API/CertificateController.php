<?php

namespace App\Http\Controllers\API;

use App\Certification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required|min:50',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $request['user_id'] = $this->guard()->user()->id;
        $certification = Certification::create($request->all());
        return response()->json($certification);
    }

    public function destroy(Certification $certificate)
    {
        $certificate->delete();
        $certifications = Certification::where('user_id', $this->guard()->user()->id)->get();
        return response()->json($certifications);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
