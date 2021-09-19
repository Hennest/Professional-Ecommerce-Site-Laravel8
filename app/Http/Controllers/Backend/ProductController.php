<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ProductAdd()
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $brands = Brand::orderBy('brand_name_eng', 'ASC')->get();
        return view('backend.product.add', compact('categories', 'brands'));
    }

    public function GetSubCategory($category_id)
    {
        $sub_cats = Subcategory::where('category_id',$category_id)->orderBy('sub_category_name_eng', 'ASC')->get();
        return json_encode($sub_cats);
    }

    public function GetSubSubCategory($sub_category_id)
    {
        $sub_sub_cats = SubSubCategory::where('sub_category_id',$sub_category_id)->orderBy('sub_sub_cat_name_eng', 'ASC')->get();
        return json_encode($sub_sub_cats);
    }

    public function ProductStore(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_subcategory_id' => 'required',
            'product_name_eng' => 'required|unique:products|max:50',
            'product_name_ban' => 'required|unique:products|max:50',
            'product_code' => 'required|unique:products|numeric',
            'product_quantity' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'product_thambnail' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // dd($request->brand_id, $request->category_id, $request->sub_category_id, $request->sub_subcategory_id,
        //     $request->product_name_eng, $request->product_name_ban, $request->product_code, $request->product_quantity, $request->selling_price, $request->discount_price);
        dd($request->product_thambnail);
    }
}
