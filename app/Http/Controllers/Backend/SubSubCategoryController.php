<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubCategory;

class SubSubCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function view()
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $sub_sub_cats = SubSubCategory::latest()->get();
        return view('backend.sub_subcategory.view', compact('categories','sub_sub_cats'));
    }

    public function GetSubCategory($category_id)
    {
        $sub_cats = Subcategory::where('category_id',$category_id)->orderBy('sub_category_name_eng', 'ASC')->get();
        return json_encode($sub_cats);
    }

    public function Add(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_sub_cat_name_eng' => 'required',
            'sub_sub_cat_name_ban' => 'required',
        ]);

        $sub_sub_cat = new SubSubCategory();
        $sub_sub_cat->category_id = $request->category_id;
        $sub_sub_cat->sub_category_id = $request->sub_category_id;
        $sub_sub_cat->sub_sub_cat_name_eng = $request->sub_sub_cat_name_eng;
        $sub_sub_cat->sub_sub_cat_slug_eng = strtolower(str_replace(' ', '-', $request->sub_sub_cat_name_eng));
        $sub_sub_cat->sub_sub_cat_name_ban = $request->sub_sub_cat_name_ban;
        $sub_sub_cat->sub_sub_cat_slug_ban = str_replace(' ', '-', $request->sub_sub_cat_name_ban);
        $sub_sub_cat->save();

        $notification = array(
            'message' => 'Added Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Edit($id){
        $sub_sub_cat = SubSubCategory::findOrFail($id);
        $selected_cat = $sub_sub_cat->category_id;
        $sub_cat = Subcategory::where('category_id',$selected_cat)->orderBy('sub_category_name_eng', 'ASC')->get();
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        return view('backend.sub_subcategory.edit', compact('categories','sub_cat','sub_sub_cat'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'sub_sub_cat_name_eng' => 'required',
            'sub_sub_cat_name_ban' => 'required',
        ]);

        $sub_sub_cat = SubSubCategory::findOrFail($id);
        if (($sub_sub_cat->category_id != $request->category_id) OR ($sub_sub_cat->sub_sub_cat_name_eng != $request->sub_sub_cat_name_eng) OR ($sub_sub_cat->sub_sub_cat_name_ban != $request->sub_sub_cat_name_ban) OR ($sub_sub_cat->sub_category_id != $request->sub_category_id)) {
        
            $sub_sub_cat->category_id = $request->category_id;
            $sub_sub_cat->sub_category_id = $request->sub_category_id;
            $sub_sub_cat->sub_sub_cat_name_eng = $request->sub_sub_cat_name_eng;
            $sub_sub_cat->sub_sub_cat_slug_eng = strtolower(str_replace(' ', '-', $request->sub_sub_cat_name_eng));
            $sub_sub_cat->sub_sub_cat_name_ban = $request->sub_sub_cat_name_ban;
            $sub_sub_cat->sub_sub_cat_slug_ban = str_replace(' ', '-', $request->sub_sub_cat_name_ban);
            $sub_sub_cat->update();

            $notification = array(
                'message' => 'Updated Successfully!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.sub_sub_category')->with($notification);
        }else{
            $notification = array(
                'message' => 'Nothing Is Updated!',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.sub_sub_category')->with($notification);
        } 
    }

    public function Delete($id)
    {
        $sub_sub_cat = SubSubCategory::findOrFail($id);
        $sub_sub_cat->delete();

        $notification = array(
            'message' => 'Deleted Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
