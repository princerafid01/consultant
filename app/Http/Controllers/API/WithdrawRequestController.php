<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\WithdrawRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithDrawings;

class WithdrawRequestController extends Controller
{
    public function withdraw_request(Request $request)
    {
        $withdraw_request =  WithdrawRequest::create($request->data);
        return response()->json($withdraw_request);
    }

    public function get()
    {
        $requests = WithdrawRequest::all();
        return response()->json($requests);
    }
}
