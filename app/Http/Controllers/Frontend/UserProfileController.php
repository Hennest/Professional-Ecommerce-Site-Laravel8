<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function UpdateProfile()
    {
        return view('profile.user_profile_update');
    }

    public function StoreProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $new_pic = $request->file('new_photo');
        $old_pic = $user->profile_photo_path;

        // dd($new_pic);

        if (($user->name != $request->name) OR ($user->email != $request->email) OR ($new_pic != null)) {
            if (($old_pic != null) AND ($new_pic != null)) {
                unlink($old_pic);
                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('upload/user_image/'.$img_gen);
                $last_img = 'upload/user_image/'.$img_gen;
                $user->profile_photo_path = $last_img;
            }
            if ($new_pic != null){
                $img_gen = hexdec(uniqid()).'.'.$new_pic->getClientOriginalExtension();
                Image::make($new_pic)->resize(300,300)->save('upload/user_image/'.$img_gen);
                $last_img = 'upload/user_image/'.$img_gen;
                $user->profile_photo_path = $last_img;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();

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
        $user = User::find(Auth::user()->id);
        $profile_pic = $user->profile_photo_path;

        if ($profile_pic) {
            unlink($profile_pic);
            $user->profile_photo_path = null;
            $user->update();

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

    public function PasswordUpdate()
    {
        return view('profile.user_password_update');
    }

    public function PasswordChange(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
            Auth::logout();
            return Redirect()->route('login');
        }else{
            return Redirect()->back()->with('warning', 'Your Current Password Is Invalid!');
        }
    }
}
