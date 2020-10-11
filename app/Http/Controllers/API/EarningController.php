<?php

namespace App\Http\Controllers\API;

use App\Earning;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function set(Request $request)
    {
        $earnings = Earning::updateOrCreate(
            ['geek_id' => $request->data['geek_id']],
            [
                'geek_id' => $request->data['geek_id'],
                'total_earnings' => $request->data['earnings']
            ]
        );

        return response()->json($earnings);
    }
}
