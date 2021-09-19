<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AdminProfile()
    {
        $adminData = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $new_pic = $request->file('new_photo');
        $old_pic = $admin->profile_photo_path;

        // dd($new_pic);

        if (($admin->name != $request->name) OR ($admin->email != $request->email) OR ($new_pic != null)) {
            if (($old_pic != null) AND ($new_pic != null)) {
                unlink($old_pic);
                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('upload/admin_image/'.$img_gen);
                $last_img = 'upload/admin_image/'.$img_gen;
                $admin->profile_photo_path = $last_img;
            }
            if ($new_pic != null){
                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('upload/admin_image/'.$img_gen);
                $last_img = 'upload/admin_image/'.$img_gen;
                $admin->profile_photo_path = $last_img;
            }

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->update();

            $notification = array(
                'message' => 'Profile Information Updated!',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Nothing Is Updated!',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function ProfilePhotoRemove()
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $profile_pic = $admin->profile_photo_path;

        if ($profile_pic) {
            unlink($profile_pic);
            $admin->profile_photo_path = null;
            $admin->update();

            $notification = array(
                'message' => 'Photo Removed Successfully!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Photo Already Removed!',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function PasswordChange()
    {
        return view('admin.admin_change_password');
    }

    public function PasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword)) {
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $admin->password = Hash::make($request->password);
            $admin->update();
            Auth::logout();
            return Redirect()->route('admin.login');
        }else{
            return Redirect()->back()->with('warning', 'Your Current Password Is Invalid!');
        }
    }
}
