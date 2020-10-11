<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $skills = Tag::all();
        return view('admin.tags.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Tag::create([
            'name' => $request->name
        ]);
        request()->session()->flash('msg', 'A Skill Successfully created!');
        return back();
    }

    public function update(Tag $tag, Request $request)
    {
        $tag->name = $request->name;
        $tag->save();
        request()->session()->flash('msg', 'A Skill Successfully edited!');
        return back();
    }
}
