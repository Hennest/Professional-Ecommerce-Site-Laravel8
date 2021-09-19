<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function SubCategoryView()
    {
        $category = Category::orderBy('category_name_eng', 'ASC')->get();
        $sub_cat = Subcategory::latest()->get();
        return view('backend.subcategory.view', compact('sub_cat', 'category'));
    }

    public function SubCategoryAdd(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'sub_category_name_eng' => 'required',
            'sub_category_name_ban' => 'required',
        ]);

        $sub_category = new Subcategory();
        $sub_category->category_id = $request->category_id;
        $sub_category->sub_category_name_eng = $request->sub_category_name_eng;
        $sub_category->sub_category_slug_eng = strtolower(str_replace(' ', '-', $request->sub_category_name_eng));
        $sub_category->sub_category_name_ban = $request->sub_category_name_ban;
        $sub_category->sub_category_slug_ban = str_replace(' ', '-', $request->sub_category_name_ban);
        $sub_category->save();

        $notification = array(
            'message' => 'Sub-Category Added Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $sub_category = Subcategory::findOrFail($id);
        return view('backend.subcategory.edit', compact('sub_category', 'categories'));
    }

    public function SubCategoryUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'sub_category_name_eng' => 'required',
            'sub_category_name_ban' => 'required',
        ]);

        $sub_cat = Subcategory::findOrFail($id);
        if (($sub_cat->category_id != $request->category_id) OR ($sub_cat->sub_category_name_eng != $request->sub_category_name_eng) OR ($sub_cat->sub_category_name_ban != $request->sub_category_name_ban)) {
        
            $sub_cat->category_id = $request->category_id;
            $sub_cat->sub_category_name_eng = $request->sub_category_name_eng;
            $sub_cat->sub_category_slug_eng = strtolower(str_replace(' ', '-', $request->sub_category_name_eng));
            $sub_cat->sub_category_name_ban = $request->sub_category_name_ban;
            $sub_cat->sub_category_slug_ban = str_replace(' ', '-', $request->sub_category_name_ban);
            $sub_cat->update();

            $notification = array(
                'message' => 'Sub-Category Updated Successfully!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.sub_category')->with($notification);
        }else{
            $notification = array(
                'message' => 'Nothing Is Updated!',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.sub_category')->with($notification);
        } 
    }

    public function SubCategoryDelete($id)
    {
        $sub_cat = Subcategory::findOrFail($id);
        $sub_cat->delete();

        $notification = array(
            'message' => 'Sub-Category Deleted Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
