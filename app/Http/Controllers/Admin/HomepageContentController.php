<?php

namespace App\Http\Controllers\Admin;

use App\HomepageContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageContentController extends Controller
{
    public function index()
    {
        $content = HomepageContent::first();
        return view('admin.homepageContent.index', compact('content'));
    }

    public function store(Request $request)
    {
        $content = HomepageContent::first();
        $content->top_area_title = $request->top_area_title;
        $content->top_area_paragraph = $request->top_area_paragraph;
        $content->middle_area_title = $request->middle_area_title;
        $content->middle_area_paragraph = $request->middle_area_paragraph;
        $content->last_area_title = $request->last_area_title;
        $content->last_area_paragraph = $request->last_area_paragraph;

        $content->box_one_title = $request->box_one_title;
        $content->box_one_sub = $request->box_one_sub;

        $content->box_two_title = $request->box_two_title;
        $content->box_two_sub = $request->box_two_sub;

        $content->box_three_title = $request->box_three_title;
        $content->box_three_sub = $request->box_three_sub;

        if ($request->file('box_one_image')) {
            $content->box_one_image = $request->file('box_one_image')->store('web_images');
        }

        if ($request->file('box_two_image')) {
            $content->box_two_image = $request->file('box_two_image')->store('web_images');
        }

        if ($request->file('box_three_image')) {
            $content->box_three_image = $request->file('box_three_image')->store('web_images');
        }


        if ($request->file('top_area_image')) {
            $content->top_area_image = $request->file('top_area_image')->store('web_images');
        }

        if ($request->file('middle_area_image')) {
            $content->middle_area_image = $request->file('middle_area_image')->store('web_images');
        }

        if ($request->file('last_area_image')) {
            $content->last_area_image = $request->file('last_area_image')->store('web_images');
        }

        $content->save();
        request()->session()->flash('msg', 'Content saved!');
        return back();
    }

    public function get()
    {
        $content = HomepageContent::first();
        return response()->json($content);
    }
}
