<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $categories = Category::all();
        $categories->map(function ($category) {
            if (isset($category->sub_categories)) {
                $category->sub_categories = explode(',', $category->sub_categories);
                $category->sub_cats =  implode(',', $category->sub_categories);
            }
            return $category;
        });
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::create([
            'name' => $request->name
        ]);
        if ($category) {
            request()->session()->flash('msg', 'Category has Successfully created!');
            return back();
        }
    }

    public function storeSub(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);
        if ($request->has('name')) {
            $category->sub_categories = $category->sub_categories ? "{$category->sub_categories},{$request->name}" : $request->name;
        }
        if ($category->save()) {
            request()->session()->flash('msg', 'Sub Category has Successfully created!');
            return back();
        }
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->edit_cat_name;
        if ($category->save()) {
            request()->session()->flash('msg', 'Category has Successfully edited!');
            return back();
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        request()->session()->flash('msg', 'Category has Successfully deleted!');
        return back();
    }

    public function updateSubCat(Request $request, Category $category)
    {
        $category->sub_categories = $request->edit_sub_cat_name;
        $category->save();
        request()->session()->flash('msg', 'Sub Category has Successfully edited!');
        return back();
    }
}
