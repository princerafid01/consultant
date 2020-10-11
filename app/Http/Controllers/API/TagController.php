<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::selectRaw('id as id, name as name')->get();
        return response()->json($tags);
    }
}
