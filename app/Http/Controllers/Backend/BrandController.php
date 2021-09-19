<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.view', compact('brands'));
    }

    public function BrandAdd(Request $request)
    {
        $validated = $request->validate([
            'brand_name_eng' => 'required|unique:brands',
            'brand_name_ban' => 'required|unique:brands',
            'brand_image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'brand_name_eng.required' => 'Input brand english name.',
            'brand_name_ban.required' => 'Input brand bangla name.',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        $brand = new Brand();
        $brand->brand_name_eng = $request->brand_name_eng;
        $brand->brand_name_ban = $request->brand_name_ban;
        $brand->brand_slug_eng = strtolower(str_replace(' ', '-', $request->brand_name_eng));
        $brand->brand_slug_ban = strtolower(str_replace(' ', '-', $request->brand_name_ban));
        $brand->brand_image = $save_url;
        $brand->save();

        $notification = array(
            'message' => 'Brand Added Successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    public function BrandUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name_eng' => 'required',
            'brand_name_ban' => 'required',
        ]);

        $new_image = $request->file('brand_image');
        $brand = Brand::findOrFail($id);
        if ($brand->brand_name_eng != $request->brand_name_eng OR $brand->brand_name_ban != $request->brand_name_ban OR $new_image != null) {
            
            if($new_image != null){
                unlink($brand->brand_image);
                $name_gen = hexdec(uniqid()).'.'.$new_image->getClientOriginalExtension();
                Image::make($new_image)->resize(300,300)->save('upload/brand/'.$name_gen);
                $save_url = 'upload/brand/'.$name_gen;

                $brand->brand_name_eng = $request->brand_name_eng;
                $brand->brand_slug_eng = strtolower(str_replace(' ','-',$request->brand_name_eng));
                $brand->brand_name_ban = $request->brand_name_ban;
                $brand->brand_slug_ban = strtolower(str_replace(' ','-',$request->brand_name_ban));
                $brand->brand_image = $save_url;
                $brand->update();

                $notification = array(
                    'message' => 'Brand Info Updated!',
                    'alert-type' => 'success'
                );

                return Redirect()->route('all.brand')->with($notification);
            }else{
                $brand->brand_name_eng = $request->brand_name_eng;
                $brand->brand_slug_eng = strtolower(str_replace(' ','-',$request->brand_name_eng));
                $brand->brand_name_ban = $request->brand_name_ban;
                $brand->brand_slug_ban = strtolower(str_replace(' ','-',$request->brand_name_ban));
                $brand->update();

                $notification = array(
                    'message' => 'Brand Info Updated!',
                    'alert-type' => 'success'
                );

                return Redirect()->route('all.brand')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Nothing Is Updated!',
                'alert-type' => 'info'
            );

            return Redirect()->route('all.brand')->with($notification);
        }
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        unlink($brand->brand_image);
        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Delete Successfully!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
