<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function CategoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.view', compact('categories'));
    }

    public function CategoryAdd(Request $request)
    {
        $validated = $request->validate([
            'category_name_eng' => 'required|unique:categories',
            'category_name_ban' => 'required|unique:categories',
            'category_icon' => 'required',
        ]);

        $category = new Category();
        $category->category_name_eng = $request->category_name_eng;
        $category->category_name_ban = $request->category_name_ban;
        $category->category_slug_eng = strtolower(str_replace(' ', '-', $request->category_name_eng));
        $category->category_slug_ban = str_replace(' ', '-', $request->category_name_ban);
        $category->category_icon = $request->category_icon;
        $category->save();

        $notification = array(
            'message' => 'Category Added Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    public function CategoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name_eng' => 'required',
            'category_name_ban' => 'required',
            'category_icon' => 'required'
        ]);

        $category = Category::findOrFail($id);
        if ($category->category_name_eng != $request->category_name_eng OR $category->category_name_ban != $request->category_name_ban OR $category->category_icon != $request->category_icon) {
            
            $category->category_name_eng = $request->category_name_eng;
            $category->category_name_ban = $request->category_name_eng;
            $category->category_slug_eng = strtolower(str_replace(' ', '-', $request->category_name_eng));
            $category->category_slug_ban = str_replace(' ', '-', $request->category_name_ban);
            $category->category_icon = $request->category_icon;
            $category->update();

            $notification = array(
                'message' => 'Category Updated Successfully!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.category')->with($notification);
        }else{
            $notification = array(
                'message' => 'Nothing Is  Updated!',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.category')->with($notification);
        }
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = array(
            'message' => 'Category Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
