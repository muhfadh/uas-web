<?php

namespace App\Http\Controllers\Author;

use App\User;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index(){
        return  view('author.settings');
    }

    public function updateProfile(Request $request){
        $customMessages = [
            'name' => 'Isi Post :attribute!',
            'email' => 'Isi Post :attribute!',
        ];
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'image'
        ], $customMessages);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::findOrFail(Auth::id());
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //
            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }

            //hapus image lama
            if(Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            $profile = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName, $profile);
        }
        else{
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::info('Profile Berhasil diperbarui :)' ,'Sukses');

        return redirect()->back();

    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->password,$hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::info('Password Berhasil diperbarui :)' ,'Sukses');
                Auth::logout();
                return redirect()->back();
            }
            else{
                Toastr::error('Password baru tidak bisa sama dengan password lama', 'Error');
                return redirect()->back();
            }
        }
        else{
            Toastr::error('Konfirmasi password tidak sama dengan password baru', 'Error');
            return redirect()->back();
        }
    }
}
